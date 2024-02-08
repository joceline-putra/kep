<script type="text/javascript">
$(document).ready(function() {  
    

    let url = '{{ url('/') }}/dashboard';
    let url_api = '{{ url('/') }}/api/master/'; 
    let url_search = '{{ url('/') }}/search';    
    // let url_image = '{{ URL::asset('/') }}storage/';  
    let url_image = '{{ url('/') }}/uploads/noimage.png';      
    let csrf_token = $('meta[name="csrf-token"]').attr('content')
    
    let userSession = '';  
    let schoolSession = '';  

    /** handle token */
    let login = '{{ url('/') }}';
    const userdata = JSON.parse(localStorage.getItem('lms-userdata'));
    // if userdata null then login page
    if(userdata == null) {
        window.location.href = login;
    }
    const bearer_token = userdata['token'];
    const token_expired_date = userdata['token_expired_date'];
    const now = new Date();
    // compare expired date with date now
    const isTokenExpired = now > new Date(token_expired_date);
    // if expired then to login page
    if (isTokenExpired) {
        window.location.href = login;
        localStorage.removeItem('lms-userdata');
    }
    /** end handle token */

    let newsSTART = 2;
    let newsLIMIT = 2; //5

    var apexOption_1 = {
        // title: { 
        //     text: 'Demography',
        //     align: 'left',
        //     style: {
        //         fontSize:  '12px',
        //         fontWeight:  'bold',
        //         fontFamily:  undefined,
        //         color:  '#263238'
        //     },
        // },
        series: [
            {
                data: [50, 20, 40, 10, 70]
            }                                                   
        ],
        chart: {
            type: 'bar',
            height: 250,
            width: "100%",
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false
            }
        },
        colors:["#db2e59", "#0090d9","#36a6a3", "#f06605"],      
        dataLabels: {
            enabled: false,
            formatter: function (val, opt) {
                return numberToLabel(val);
            },              
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            floating: false,
            // offsetY: ,
            // offsetX: -5,
        },   
        markers: {
            size: 8,
        },           
        stroke: {
            width: [4],
            curve: 'straight', //straight, stepline, smooth,
            // curve: ['smooth', 'straight', 'stepline']
        },
        grid: {
            row: {
                // colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                // opacity: 0.5
            },
            column:{
                colors: undefined,
                opacity: 0.5
            },
            xaxis: {
                lines: {
                    show: true
                }
            },   
            yaxis: {
                lines: {
                    show: false
                }
            },                  
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: false,
            }
        },      
        xaxis: {
            labels: {
                show: true,
                formatter: function (value) {
                    // console.log('AS '+value);
                    // return 'X Axis';
                    return value;
                }
            },                
            title: { text: ''},
            categories: ['Jawa Tengah', 'Bali', 'Sumatera Selatan', 'DKI Jakarta', 'DIY Yogyakarta']                
        },
        yaxis: {
            labels: {
                show: true,
                formatter: function (value) {
                    return numberToLabel(value);
                }
            },                
            title: { 
                text: ''
            },/* min: 5, max: 40*/
        }          
    };        
    var apexOption_2 = {
        // title: { 
        //     text: '',
        //     align: 'center',
        //     style: {
        //         fontSize:  '12px',
        //         fontWeight:  'bold',
        //         fontFamily:  undefined,
        //         color:  '#263238'
        //     },
        // },
        series: [150,40,45,25,85],
        chart: {
            type: 'pie',
            height: 300,
            width: "100%",
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false
            }
        },
        labels:['SMA 1 Semarang','SMP 4 Semarang','MTS Umul Albab','SMK 2 Jogja','SDN 1 Uluwatu'],
        colors:["#db2e59", "#f06605", "#0090d9", "#36a6a3", "#36a6a3"],     
        dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
                return val.toFixed(0)+' student';
            },              
        },          
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            floating: false,
            offsetY: -10,
            offsetX: -5
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: false,
            }
        },   
        tooltip: {
            y: {
                formatter: function(val,opt) {
                return numberToLabel(val);
                }
            }
        }
    };          
    var apex_1 = new ApexCharts(document.querySelector("#chart_one"), apexOption_1); 
    var apex_2 = new ApexCharts(document.querySelector("#chart_two"), apexOption_2);     
    apex_1.render();
    apex_2.render();

    function loadCard(){
        let form = new FormData();
        form.append('action','load_super_admin_card');
        $.ajax({
            type: "post",
            url: url,
            data: form, 
            dataType: 'json', cache: 'false', 
            contentType: false, processData: false,
            beforeSend:function(x){
                x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
            },
            success:function(d){
                let s = d.status;
                let m = d.message;
                let r = d.data;
                if(parseInt(s) == 1){
                    // notif(s,m);
                    $("#total_grade").html(r.total_grade);
                    $("#total_teacher").html(r.total_teacher);
                    $("#total_student").html(r.total_student);
                    $("#total_school").html(r.total_school);                                                            
                }else{
                    notif(s,m);
                    $("#total_grade").html(0);
                    $("#total_teacher").html(0);
                    $("#total_student").html(0);
                    $("#total_school").html(0);                       
                }
            },
            error:function(xhr,status,err){
                notif(0,err);
            }
        });
    }
    function loadLastSchoolRegister(){
        var top_school = [
            {
                name: 'SMA 1 Semarang',
                src: '../velzon/images/companies/img-1.png',
                city: 'Kota Semarang, Jawa Tengah',
                date: '7 hari yg lalu'
            },
            {
                name: 'SMA 4 Semarang',
                src: '../velzon/images/companies/img-2.png',
                city: 'Kota Semarang, Jawa Tengah',
                date: '1 bulan yg lalu'
            },
            {
                name: 'MTS Jogja',
                src: '../velzon/images/companies/img-3.png',
                city: 'Sleman, DIY Yogyakarta',
                date: '3 bulan yg lalu'
            },
            {
                name: 'SMK 2 Uluwatu',
                src: '../velzon/images/companies/img-8.png',
                city: 'Uluwatu, Bali',
                date: '5 bulan yg lalu'
            },
            {
                name: 'Universitas Airlangga',
                src: '../velzon/images/companies/img-5.png',
                city: 'Kota Surabaya, Jawa Timur',
                date: '1 tahun yg lalu'
            }                
        ];
        let total_records = top_school.length;
        if(parseInt(total_records) > 0){
            $("#school_last_register tbody").html('');
        
            var dsp = '';
            top_school.forEach(async (v, i) => {
        
                dsp += '<tr>';
                    // dsp += '<td>'+v['name']+'</td>';
                    // dsp += '<td>'+v['src']+'</td>';
                    dsp += `<td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="${v['src']}" alt="" class="avatar-sm p-2" />
                                    </div>
                                    <div>
                                        <h5 class="fs-14 my-1 fw-medium">
                                            <a href="apps-ecommerce-seller-details.html" class="text-reset">${v['name']}</a>
                                        </h5>
                                        <span class="text-muted">${v['city']}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted">${v['date']}</span>
                            </td>`;                
                dsp += '</tr>';
        
            });
            $("#school_last_register tbody").html(dsp);
        }        
    }
    function numberToLabel(num) {
        if (num >= 1000000000) {
            return (num / 1000000000).toFixed(1).replace(/\.0$/, '') + ' B';
        }
        if (num >= 1000000) {
            return (num / 1000000).toFixed(1).replace(/\.0$/, '') + ' M';
        }
        if (num >= 1000) {
            return (num / 1000).toFixed(1).replace(/\.0$/, '') + ' k';
        }
        return num;
    }   
    loadCard();
    loadLastSchoolRegister();
       
});  
</script>