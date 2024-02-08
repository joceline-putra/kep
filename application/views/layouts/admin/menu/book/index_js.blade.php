<script type="text/javascript">
$(document).ready(function() {  
    $.alert('Simpan masih gagal');
    let url = '{{ url('/') }}/e-book';
    let url_api = '{{ url('/') }}/api/master/'; 
    let url_search = '{{ url('/') }}/search';    
    // let url_image = '{{ URL::asset('/') }}storage/';  
    let url_image = '{{ url('/') }}/uploads/noimage.png';          
    let csrf_token = $('meta[name="csrf-token"]').attr('content')
    
    let bookSession = '';  
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
    

    $('#book_type').select2({
        dropdownParent:$("#modal_book"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
        //placeholder: '<i class="fas fa-search"></i> Search',
        //width:'100%',
        // tags:true,
        // minimumInputLength: 0,
        placeholder: {
            id: '0',
            text: 'Select'
        },
        allowClear: true,
        // minimumResultsForSearch: Infinity,
        ajax: {
            type: "post",
            url: url_search,
            dataType: 'json',
            delay: 250,
            beforeSend:function(x){
                x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
            },             
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'book_type'
                };
                return query;
            },
            processResults: function (data){
                var datas = [];
                $.each(data, function(key, val){
                    datas.push({
                        'id' : val.id,
                        'text' : val.text
                    });
                });
                return {
                    results: datas
                };
            },
            cache: true
        },
        escapeMarkup: function(markup){ 
            return markup; 
        },
        templateResult: function(datas){ //When Select on Click
            return datas.text;
        },
        templateSelection: function(datas) { //When Option on Click
            return datas.text;
        }
    });        
    $('#book_topic').select2({
        dropdownParent:$("#modal_book"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
        //placeholder: '<i class="fas fa-search"></i> Search',
        //width:'100%',
        // tags:true,
        // minimumInputLength: 0,
        placeholder: {
            id: '0',
            text: 'Select'
        },
        allowClear: true,
        // minimumResultsForSearch: Infinity,
        ajax: {
            type: "post",
            url: url_search,
            dataType: 'json',
            delay: 250,
            beforeSend:function(x){
                x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
            },             
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'book_topic'
                };
                return query;
            },
            processResults: function (data){
                var datas = [];
                $.each(data, function(key, val){
                    datas.push({
                        'id' : val.id,
                        'text' : val.text
                    });
                });
                return {
                    results: datas
                };
            },
            cache: true
        },
        escapeMarkup: function(markup){ 
            return markup; 
        },
        templateResult: function(datas){ //When Select on Click
            return datas.text;
        },
        templateSelection: function(datas) { //When Option on Click
            return datas.text;
        }
    });
    $('#book_publisher').select2({
        dropdownParent:$("#modal_book"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
        //placeholder: '<i class="fas fa-search"></i> Search',
        //width:'100%',
        // tags:true,
        // minimumInputLength: 0,
        placeholder: {
            id: '0',
            text: 'Select'
        },
        allowClear: true,
        // minimumResultsForSearch: Infinity,
        ajax: {
            type: "post",
            url: url_search,
            dataType: 'json',
            delay: 250,
            beforeSend:function(x){
                x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
            },             
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'book_publisher'
                };
                return query;
            },
            processResults: function (data){
                var datas = [];
                $.each(data, function(key, val){
                    datas.push({
                        'id' : val.id,
                        'text' : val.text
                    });
                });
                return {
                    results: datas
                };
            },
            cache: true
        },
        escapeMarkup: function(markup){ 
            return markup; 
        },
        templateResult: function(datas){ //When Select on Click
            return datas.text;
        },
        templateSelection: function(datas) { //When Option on Click
            return datas.text;
        }
    });       
    // $('#book_school').select2({
    //     dropdownParent:$("#modal_book"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
    //     //placeholder: '<i class="fas fa-search"></i> Search',
    //     //width:'100%',
    //     // tags:true,
    //     // minimumInputLength: 0,
    //     placeholder: {
    //         id: '0',
    //         text: 'Select'
    //     },
    //     allowClear: true,
    //     // minimumResultsForSearch: Infinity,
    //     ajax: {
    //         type: "post",
    //         url: url_search,
    //         dataType: 'json',
    //         delay: 250,
    //         beforeSend:function(x){
    //             x.setRequestHeader('Authorization',"Bearer " + bearer_token);
    //             x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
    //         },             
    //         data: function (params) {
    //             var query = {
    //                 search: params.term,
    //                 action: 'school'
    //             };
    //             return query;
    //         },
    //         processResults: function (data){
    //             var datas = [];
    //             $.each(data, function(key, val){
    //                 datas.push({
    //                     'id' : val.session,
    //                     'text' : val.text
    //                 });
    //             });
    //             return {
    //                 results: datas
    //             };
    //         },
    //         cache: true
    //     },
    //     escapeMarkup: function(markup){ 
    //         return markup; 
    //     },
    //     templateResult: function(datas){ //When Select on Click
    //         return datas.text;
    //     },
    //     templateSelection: function(datas) { //When Option on Click
    //         return datas.text;
    //     }
    // }); 
    $('#book_grade').select2({
        dropdownParent:$("#modal_book"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
        //placeholder: '<i class="fas fa-search"></i> Search',
        //width:'100%',
        // tags:true,
        // minimumInputLength: 0,
        placeholder: {
            id: '0',
            text: 'Select'
        },
        allowClear: true,
        // minimumResultsForSearch: Infinity,
        ajax: {
            type: "post",
            url: url_search,
            dataType: 'json',
            delay: 250,
            beforeSend:function(x){
                x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
            },             
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'grade'
                };
                return query;
            },
            processResults: function (data){
                var datas = [];
                $.each(data, function(key, val){
                    datas.push({
                        'id' : val.session,
                        'text' : val.text
                    });
                });
                return {
                    results: datas
                };
            },
            cache: true
        },
        escapeMarkup: function(markup){ 
            return markup; 
        },
        templateResult: function(datas){ //When Select on Click
            return datas.text;
        },
        templateSelection: function(datas) { //When Option on Click
            return datas.text;
        }
    });       

    //Datatable
    let data_table = $("#table_book").DataTable({
        "responsive": true,
        "serverSide": true,            
        "ajax": {
            url: url,
            type: 'post',
            dataType: 'json',
            cache: 'false',
            data: function(d) {
                d._token = '{{ csrf_token() }}';                
                d.action = 'load';
                // d.length = $("#filter_length").find(':selected').val();
                // d.date_start = $("#filter_start_date").val();
                // d.date_end = $("#filter_end_date").val();
                // d.search = {value:$("#filter_search").val()};
            },
            dataSrc: function(data) {
                return data.result;
            }
        },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "columnDefs": [
            {"targets":0, "width":"30%", "title":"Title", "searchable":true, "orderable":true},            
            {"targets":1, "width":"30%", "title":"Publisher", "searchable":true, "orderable":true},
            {"targets":2, "width":"20%", "title":"Topic", "searchable":true, "orderable":true, "className":"dt-body-left"},
            {"targets":3, "width":"20%", "title":"Type", "searchable":true, "orderable":true},            
            {"targets":4, "width":"20%", "title":"Status", "searchable":true, "orderable":true},
            {"targets":5, "width":"20%", "title":"Action", "searchable":true, "orderable":true},                      
        ],
        "order": [[0, 'ASC']],
        "columns": [{
                'data': 'book_title',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'publisher_name',
                className: 'text-right',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'topic_name',
                render: function(data, meta, row) {
                    var dsp = '-';
                    return data;
                }
            },{
                'data': 'type_name',
                className: 'text-left',
                render: function(data, meta, row) {
                    return data;
                }
            },{
                'data': 'book_status',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    if(row.book_status == 0){
                        dsp += '<span class="badge bg-warning-subtle text-warning">Inactive</span>';
                    }else if(row.book_status == 1){
                        dsp += '<span class="badge bg-success-subtle text-success">Active</span>';
                    }else if(row.book_status == 4){
                        dsp += '<span class="badge bg-danger-subtle text-danger">Deleted</span>';
                    }
                    return dsp;
                }
            },{
                'data': 'book_id',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    dsp += `
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="#" class="dropdown-item btn_edit" data-id="${data}" data-session="${row.book_session}" data-name="${row.book_title}">
                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item remove-item-btn btn_delete" data-id="${data}" data-session="${row.book_session}" data-name="${row.book_title}" style="cursor:pointer">
                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                </a>
                            </li>
                        </ul>
                    </div>`;
                    // <li>
                    //     <a href="#" class="dropdown-item edit-item-btn btn_edit" data-id="${data}" data-session="${row.user_session}" data-name="${row.menu_name}" style="cursor:pointer">
                    //         <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                    //     </a>
                    // </li>                    
                    return dsp;
                }
            }
        ]
    });
    // $("#table_book_filter").css('display','none');
    // $("#table_book_length").css('display','none');
    $("#filter_length").on('change', function(e){
        var value = $(this).find(':selected').val(); 
        $('select[name="table_book_length"]').val(value).trigger('change');
        data_table.ajax.reload();
    });
    $("#filter_flag").on('change', function(e){ data_table.ajax.reload(); });
    $("#filter_search").on('input', function(e){ var ln = $(this).val().length; if(parseInt(ln) > 3){ data_table.ajax.reload(); }else if(parseInt(ln) < 1){ data_table.ajax.reload();} });

    let userBirthDate = $("#user_birth").flatpickr({
        dateFormat: 'd-m-Y',
        allowInput: true,
        static:true,
        onOpen: (selectedDates, dateStr, instance) => { // rewrite the picker date
            // $("#flatpickr-date").removeAttr('tabindex');
        },
        onClose: (selectedDates, dateStr, instance) => { // rewrite the picker date
            instance.setDate(selectedDates, instance, dateStr);
            // $("#flatpickr-date").attr('tabindex',-1);
        }       
    });      

    $('input:radio[name="book_status"]').on('change', function(e){
        var v = $(this).val();
        $("input[name=book_status][value!='"+v+"']").removeAttr('checked');
        $("input[name=book_status][value='"+v+"'").attr('checked', 'checked');
    });    
    $('#book_subscription').on('change', function(e){
        var v = $(this).val();
        if (v == 2) {
            $('.book-price').show();
        }else {
            $('.book-price').hide();
        }
    });    
    
    /* CRUD */
    $(document).on("click","#btn_new",function(e) {
        e.preventDefault();
        e.stopPropagation();
        formBookReset();
        $("#modal_book").modal('show');
    });
    $(document).on("click","#btn_close",function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#modal_book").modal('hide');
        formBookReset();
    });
    $(document).on("click","#btn_save", function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        
        if(next){
            if ($("#book_grade").find(":selected").val() == 0) {
                next = false;
                notif(0,'Grade required');
            }
        }   

        if(next){
            if ($("#book_type").find(":selected").val() == 0) {
                next = false;
                notif(0,'Type required');
            }
        }    

        if(next){
            if ($("#book_topic").find(":selected").val() == 0) {
                next = false;
                notif(0,'Topic required');
            }
        } 
        
        if(next){
            if ($("#book_publisher").find(":selected").val() == 0) {
                next = false;
                notif(0,'Publisher required');
            }
        }         

        if(next){
            let form = new FormData($("#form_book")[0]);
            // form.append('_token','{{ csrf_token() }}');  
            form.append('action','create');
            form.set('book_status',$("input[name=book_status]:checked").val());
            // form.append('user_remember_token',8);
            // form.append('uploads_base64', $("#files_preview").attr('data-save-img')); 
            if(bookSession == ''){
                var set_url = url_api + 'book-create';
            }else{              
                form.append('book_session',bookSession);
                var set_url = url_api + 'book-update';
            }
            $.ajax({
                type: "post",
                url: set_url,
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
                        notif(s,m);
                        if(bookSession == ''){
                            data_table.ajax.reload();
                        }else{              
                            data_table.ajax.reload(null,false);
                        }                        
                        bookSession = r.user_session;
                        $("#modal_book").modal('hide');
                    }else{
                        notif(s,m);
                    }
                },
                error:function(xhr,status,err){
                    notif(0,err);
                }
            });
        }   
    });
    $(document).on("click",".btn_edit", function (e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        
        bookSession = $(this).attr('data-session');
        
        if(next){
            if (bookSession.length === 0) {
                next = false;
                notif(0,'Data tidak ada');
            }
        }

        if(next){
            let form = new FormData();
            // form.append('action','read');
            form.append('book_session',bookSession);
            $.ajax({
                type: "post",
                url: url_api + 'book-data',
                // url:url,
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
                        notif(s,m);
                        // data_table.ajax.reload();
                        formBookReset();
                        $("#modal_book").modal('show');
                        bookSession = r.book_session;
                        $("#book_title").val(r.book_title);
                        $("#book_price").val(r.book_price);
                        $("#book_subscription").val(r.book_subscription).trigger('change');  
                        $("#book_description").val(r.book_description);

                        $('input[name=book_status][value='+r.book_status+']').prop("checked", true).change();   

                        // if(!r.rl_book_type){
                            $("select[id='book_type']").append(''+'<option value="'+r.rl_book_type.type_id+'">'+r.rl_book_type.type_name+'</option>');
                            $("select[id='book_type']").val(r.rl_book_type.type_id).trigger('change');
                        // }
                        // if(!r.rl_book_topic){
                            $("select[id='book_topic']").append(''+'<option value="'+r.rl_book_topic.topic_id+'">'+r.rl_book_topic.topic_name+'</option>');
                            $("select[id='book_topic']").val(r.rl_book_topic.topic_id).trigger('change');
                        // }
                        // if(r.rl_book_publisher != 'undefined'){
                            $("select[id='book_publisher']").append(''+'<option value="'+r.rl_book_publisher.publisher_id+'">'+r.rl_book_publisher.publisher_name+'</option>');
                            $("select[id='book_publisher']").val(r.rl_book_publisher.publisher_id).trigger('change');
                        // }
                        // $("select[id='book_school']").append(''+'<option value="'+r.rl_book_publisher.publisher_id+'">'+r.rl_book_publisher.publisher_name+'</option>');
                        // $("select[id='book_school']").val(r.rl_book_publisher.type_id).trigger('change');                         
                        $("select[id='book_grade']").append(''+'<option value="'+r.rl_grade.grade_session+'">'+r.rl_grade.grade_name+'</option>');
                        $("select[id='book_grade']").val(r.rl_grade.grade_session).trigger('change');          
 
                    }else{
                        notif(s,m);
                        bookSession = '';
                    }
                },
                error:function(xhr,status,err){
                    notif(0,err);
                }
            });
        }   
    });
    $(document).on("click",".btn_delete",function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        bookSession = $(this).attr('data-session');
        var bookName = $(this).attr('data-name');        

        let title   = 'Confirmation';
        let content = 'Are you sure to remove <b>'+bookName+'</b> ?';
        $.confirm({
            title: title,
            content: content,
            columnClass: 'col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',
            // closeIcon: true, closeIconClass: 'fas fa-times',
            animation:'zoom', closeAnimation:'bottom', animateFromElement:false, useBootstrap:true,
            buttons: {
                button_1: {
                    text:'<i class="fas fa-trash"></i> Delete',
                    btnClass: 'btn-danger',
                    keys: ['enter'],
                    action: function(){
                        if(!bookSession){
                            next = false;
                            notif(0,'Data not found');
                        }
                    
                        if(next){
                            let form = new FormData(); 
                            // form.append('action','delete');
                            form.append('book_session',bookSession);
                            var set_url = url_api + 'book-delete';
                            $.ajax({
                                type: "post",
                                url: set_url,
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
                                    let r = d.result;
                                    if(parseInt(s) == 1){
                                        notif(s,m);
                                        data_table.ajax.reload(null,false);
                                    }else{
                                        notif(s,m);
                                    }
                                },
                                error:function(xhr,status,err){
                                    notif(0,err);
                                }
                            });
                        } 
                    }
                },
                button_2: {
                    text: '<i class="fas fa-times"></i> Close',
                    btnClass: 'btn-default',
                    keys: ['Escape'],
                    action: function(){
                        //Close
                    }
                }
            }
        });  
    });    
    function formBookReset(){
        bookSession = '';
        schoolSession = '';
        $("#form_book input")
        .not("input[name='book_status']").val('');
        $("input[name=book_status][value=1]").prop("checked", true).change();
        $("#form_book select").val(0).trigger('change');   
        $("#book_subscription").val(1).trigger('change');            
        $("#files_preview").attr('src',url_image);    
        // $("#menu_parent_id").html('<option value="0">Select</option>');      
    }
});   
</script>