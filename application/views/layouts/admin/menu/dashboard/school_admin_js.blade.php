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
        /*
        title: { 
            text: '',
            align: 'center',
            style: {
                fontSize:  '12px',
                fontWeight:  'bold',
                fontFamily:  undefined,
                color:  '#263238'
            },
        },
        */
        series: [5,10,15,30,40],
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
        labels:['X IPA','X IPS','XI IPA','XI IPS','Not Set'],
        colors:["#f06605", "#0090d9", "#36a6a3", "#36a6a3", "#db2e59"],     
        dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
                return val.toFixed(0) + ' student';
            },              
        },          
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            floating: false,
            offsetY: 10,
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
    var apexOption_2 = {
        /*
        title: { 
            text: '',
            align: 'center',
            style: {
                fontSize:  '12px',
                fontWeight:  'bold',
                fontFamily:  undefined,
                color:  '#263238'
            },
        },
        */
        series: [{
            data: [5, 2, 11, 7, 5]              
        }],
        chart: {
            type: 'bar',
            height: 250,
            width: "100%",
            zoom: {
                enabled: false
            },
            toolbar: {
                show: true
            }
        },
        colors:['#db2e59', '#f06605', '#0090d9', '#36a6a3', '#36a6a3'],          
        dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
                return numberToLabel(val)
            },
        },
        markers: {
            size: 0,
        },            
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            // floating: true,
            // offsetY: 0,
            // offsetX: -5
        },            
        stroke: {
            curve: 'smooth', //straight, stepline, smooth,
            // curve: ['smooth', 'straight', 'stepline']
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
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
                horizontal: true,
            }
        },      
        xaxis: {
            labels: {
                show: true,
                formatter: function (value) {
                    // return 'X Axis';
                }
            },                
            title: { text: ''},
            categories: ['Biologi', 'Bahasa', 'Fisika', 'Matematika', 'PPKn']                
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
        
    var apex_1 = new ApexCharts(document.querySelector("#chart_one"), apexOption_1); 
    var apex_2 = new ApexCharts(document.querySelector("#chart_two"), apexOption_2);        
    apex_1.render();
    apex_2.render();    

    function loadCard(){
        let form = new FormData();
        form.append('action','load_school_admin_card');
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
                    $("#total_book").html(r.total_book);                                                            
                }else{
                    notif(s,m);
                    $("#total_grade").html(0);
                    $("#total_teacher").html(0);
                    $("#total_student").html(0);
                    $("#total_book").html(0);                       
                }
            },
            error:function(xhr,status,err){
                notif(0,err);
            }
        });
    }
    function loadNews(){
        $("#btn_news_load_more").html('<span class="fas fas-spinner fa-spin"></span> Loading ...');
        let form = new FormData();
        form.append('action','load_news');
        form.append('start',newsSTART);
        form.append('limit',newsLIMIT);                
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
                    let total_records = r.length;
                    if(parseInt(total_records) > 0){
                        // $("#table_id tbody").html('');
                    
                        var dsp = '';
                        r.forEach(async (v, i) => {
                    
                                // dsp += '<td>'+v['col_1']+'</td>';
                                dsp +=`<div class="d-flex mt-4">
                                <div class="flex-shrink-0">
                                    <img src="http://localhost:8000/uploads/users/3028972742.jpg" class="rounded img-fluid" style="height: 60px;" alt="">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 lh-base"><a href="#" class="text-reset">${v['news_title']}</a></h6>
                                    <p class="text-muted fs-12 mb-0">${moment(v['news_publish_date']).format("MMM DD, YYYY")}<i class="mdi mdi-circle-medium align-middle mx-1"></i>${moment(v['news_publish_date']).format("HH:mm")}</p>
                                </div>
                            </div>`;
                        });
                        /*
                         // yyyy = 2023, yy = 23
                         // MM = December, M = Dec, m = 12
                         // DD = Selasa, D = Sel, dd = 01, d = 1
                         */
                        /* #Datepicker */
                        // $("#selector").datepicker("update", variable_date_dd_mm_yyyy);
                        // $("#selector").datepicker("update", moment(variable_date_dd_mm_yyyy).format("DD-MMM-YYYY, HH:mm"));
                        // $("#selector").datepicker("getFormattedDate","yyyy-mm-dd");
                        
                        // // Set
                        // $("#selector").datepicker("update", moment().format("DD-MM-YYYY"));
                        // $("#selector").datepicker("update", moment().add(1, "days").format("DD-MM-YYYY"));
                        // $("#selector").val(moment(variable_date_dd_mm_yyyy).format("DD-MMM-YYYY, HH:mm"));
                        
                        $("#news_card").append(dsp);
                        $("#btn_news_load_more").html('<span class="fas fas-spinner"></span> Load more');                             
                    }                                        
                }else{
                    notif(s,m);                      
                }        
            },
            error:function(xhr,status,err){
                notif(0,err);
            }
        });
           
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
    loadNews();
    $(document).on("click","#btn_news_load_more", function(e){
        e.preventDefault();
        e.stopPropagation();
        newsSTART = newsSTART + 2;
        loadNews();
    });
    
});  
</script>