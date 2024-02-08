<script type="text/javascript">
$(document).ready(function() {
    let url = '{{ url('/') }}/news';
    let url_api = '{{ url('/') }}/api/master/';
    let url_search = '{{ url('/') }}/search';
    // let url_image = '{{ URL::asset('/') }}storage/';  
    let url_image = '{{ url('/') }}/uploads/noimage.png';      
    let csrf_token = $('meta[name="csrf-token"]').attr('content')

    let newsSession = '';
    let schoolSession = '';
    let userSession = '';

    /** handle token */
    let login = '{{ url('/') }}';
    const userdata = JSON.parse(localStorage.getItem('lms-userdata'));
    if(userdata == null) {
        window.location.href = login;
    }
    const bearer_token = userdata['token'];
    const token_expired_date = userdata['token_expired_date'];
    const now = new Date();
    // compare expired date with date now
    const isTokenExpired = now > new Date(token_expired_date);
    userSession = userdata.user_session;
    // if expired then to login page
    if (isTokenExpired) {
        window.location.href = login;
        localStorage.removeItem('lms-userdata');
    }
    /** end handle token */

    /** ckeditor */
    var ckClassicEditor = document.querySelectorAll("#news_content")
        ckClassicEditor.forEach(function () {
            ClassicEditor
        .create( document.querySelector( '#news_content' ) )
        .then( function(editor) {
            editor.ui.view.editable.element.style.height = '200px';
            ckClassicEditor = editor;
        } )
        .catch( function(error) {
            console.error( error );
        } );
    });

    /** Flatpicker */
    // let newsPublishDate = new flatpickr('#news_publish_date', {
    //     altInput: true,
    //     altInputClass: 'form-control',
    //     dateFormat: 'YYYY-MM-DD',
    //     altFormat: 'DD-MM-YYYY',
    //     allowInput: true,
    //     defaultDate: moment().format("YYYY-MM-DD").toString(),
    //     parseDate: (datestr, format) => {
    //         return moment(datestr, format, true).toDate();
    //     },
    //     formatDate: (date, format, locale) => {
    //         return moment(date).format(format)
    //     }
    // });
    // let newsExpiredDate = new flatpickr('#news_expired_date', {
    //     altInput: true,
    //     altInputClass: 'form-control',
    //     dateFormat: 'YYYY-MM-DD',
    //     altFormat: 'DD-MM-YYYY',
    //     allowInput: true,
    //     defaultDate: moment().format("YYYY-MM-DD").toString(),
    //     parseDate: (datestr, format) => {
    //         return moment(datestr, format, true).toDate();
    //     },
    //     formatDate: (date, format, locale) => {
    //         return moment(date).format(format)
    //     }
    // });    
    // console.log(newsPublishDate.formatDate('2023-01-01 00:00:00', "DD-MM-YYYY"));
    // console.log(newsExpiredDate.formatDate('2023-01-30 00:00:00', "DD-MM-YYYY"));    
    let newsPublishDate = $("#news_publish_date").flatpickr({
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
    let newsExpiredDate = $("#news_expired_date").flatpickr({
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

    //Croppie
    let image_width = 400;
    let image_height = 400;      
    let upload_crop_img = null;
    upload_crop_img = $('#modal_croppie_canvas').croppie({
        enableExif: true,
        viewport: {width: image_width, height: image_height},
        boundary: {width: parseInt(image_width)+10, height: parseInt(image_height)+10},
        url: url_image,
    });

    //Datatable
    let data_table = $("#table_news").DataTable({
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
            {"targets":1, "width":"20%", "title":"Author", "searchable":true, "orderable":true},
            {"targets":2, "width":"20%", "title":"Publish Date", "searchable":true, "orderable":true},
            {"targets":3, "width":"30%", "title":"Expired Date", "searchable":true, "orderable":true},
            {"targets":4, "width":"30%", "title":"Status", "searchable":true, "orderable":true},
            {"targets":5, "width":"30%", "title":"Action", "searchable":true, "orderable":true},            
        ],
        "order": [[0, 'ASC']],
        "columns": [{
                'data': 'news_title',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'user_fullname',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'news_publish_date',
                render: function(data, meta, row) {
                    var dsp = '-';
                    return moment(data).format("DD-MMM-YYYY");
                }
            },{
                'data': 'news_expired_date',
                className: 'text-left',
                render: function(data, meta, row) {
                    return moment(data).format("DD-MMM-YYYY");
                }
            },{
                'data': 'news_status',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    if(row.news_status == 0){
                        dsp += '<span class="badge bg-warning-subtle text-warning">Inactive</span>';
                    }else if(row.news_status == 1){
                        dsp += '<span class="badge bg-success-subtle text-success">Active</span>';
                    }else if(row.news_status == 4){
                        dsp += '<span class="badge bg-danger-subtle text-danger">Deleted</span>';
                    }
                    return dsp;
                }
            },{
                'data': 'news_id',
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
                                <a href="#" class="dropdown-item btn_edit" data-id="${data}" data-session="${row.news_session}" data-name="${row.news_title}">
                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item remove-item-btn btn_delete" data-id="${data}" data-session="${row.news_session}" data-name="${row.news_title}" style="cursor:pointer">
                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                </a>
                            </li>
                        </ul>
                    </div>`;
                    // <li>
                    //     <a href="#" class="dropdown-item edit-item-btn btn_edit" data-id="${data}" data-session="${row.news_session}" data-name="${row.menu_name}" style="cursor:pointer">
                    //         <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                    //     </a>
                    // </li>
                    return dsp;
                }
            }
        ]
    });
    $("#table_news_filter").css('display','none');
    $("#table_news_length").css('display','none');
    $("#filter_length").on('change', function(e){
        var value = $(this).find(':selected').val();
        $('select[name="table_news_length"]').val(value).trigger('change');
        data_table.ajax.reload();
    });
    $("#filter_flag").on('change', function(e){ data_table.ajax.reload(); });
    $("#filter_search").on('input', function(e){ var ln = $(this).val().length; if(parseInt(ln) > 3){ data_table.ajax.reload(); }else if(parseInt(ln) < 1){ data_table.ajax.reload();} });

    /* Select2 */
    $('#user_grade').select2({
        dropdownParent:$("#modal_news"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
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
                    school: schoolSession,
                    action: 'grade'
                };
                return query;
            },
            processResults: function (data){
                console.log(data);
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
            //if (!datas.id) { return datas.text; }
            if($.isNumeric(datas.id) == true){
                // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            }
        },
        templateSelection: function(datas) { //When Option on Click
            //if (!datas.id) { return datas.text; }
            //Custom Data Attribute
            //$(datas.element).attr('data-column', datas.column);
            //return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
            if($.isNumeric(datas.id) == true){
                // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            }
        }
    });
    $('#user_school').select2({
        dropdownParent:$("#modal_news"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
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
                    action: 'school'
                };
                return query;
            },
            processResults: function (data){
                console.log(data);
                var datas = [];
                $.each(data, function(key, val){
                    datas.push({
                        'id' : val.session,
                        'text' : val.text
                    });
                });
                console.log('datas', datas);
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
            //if (!datas.id) { return datas.text; }
            // if($.isNumeric(datas.id) == true){
            //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            // }
        },
        templateSelection: function(datas) { //When Option on Click
            //if (!datas.id) { return datas.text; }
            //Custom Data Attribute
            //$(datas.element).attr('data-column', datas.column);
            //return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
            // if($.isNumeric(datas.id) == true){
            //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            // }
        }
    });
    function setSelectGrade(session=null) {
        $.ajax({
            type: "GET",
            url: url_search,
            data: {
                school: schoolSession,
                action: 'grade'
            },
            dataType: 'json',
            success: function(data) {
                var options = [];
                $.each(data, function(i, val) {
                    options.push('<option value="' + val.session + '">' + val.text + '</option>');
                });
                if((session)) {
                    $("#user_grade").val(session).trigger('change');
                }
                $('#user_grade').empty().append(options.join(''));
            }
        });
    };
    $('#user_school').on('change', function() {
        schoolSession = $(this).val();
        setSelectGrade();
    });

    $('input:radio[name="news_status"]').on('change', function(e){
        var v = $(this).val();
        $("input[name=news_status][value!='"+v+"']").removeAttr('checked');
        $("input[name=news_status][value='"+v+"'").attr('checked', 'checked');
        // if(v == 0){
        //     $("#group").val(0).trigger('change');
        //     $("#group").attr('disabled',true);
        // }else{
        //     $("#group").removeAttr('disabled');
        // }
    });

    /* CRUD */
    $(document).on("click","#btn_new",function(e) {
        e.preventDefault();
        e.stopPropagation();
        formReset();
        $("#modal_news").modal('show');
    });
    $(document).on("click","#btn_close",function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#modal_news").modal('hide');
        formReset();
    });
    $(document).on("click","#btn_save", function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;

        if(next){
            if ($("#news_title").val().length === 0) {
                next = false;
                notif(0,'Title required');
            }
        }

        if(next){
            if ($("#news_publish_date").val().length === 0) {
                next = false;
                notif(0,'Publish Date required');
            }
        }

        if(next){
            if ($("#news_expired_date").val().length === 0) {
                next = false;
                notif(0,'Expired Date required');
            }
        }        

        if(next){
            let form = new FormData($("#form_news")[0]);
            // form.append('_token','{{ csrf_token() }}');
            // form.append('user_remember_token', '2');
            form.append('action','create');
            // form.append('news_title',$("#news_title").val());
            form.set('news_content', ckClassicEditor.getData());
            form.set('news_publish_date',moment(newsPublishDate.selectedDates[0]).format("YYYY-MM-DD"));
            form.set('news_expired_date',moment(newsExpiredDate.selectedDates[0]).format("YYYY-MM-DD"));
            form.set('news_author',userSession);
            form.set('news_status',$("input[name=news_status]:checked").val());
            // console.log($("#form_news")[0].files.length);
            // if ($("#form_news")[0].files.length === 0) { 
            //     form.set('uploads','');
            // }           
            // form.append('uploads', $("#files_preview").attr('data-save-img')); 
            // form.append('uploads_base64', $("#files_preview").attr('data-save-img'));             
            if(newsSession == ''){
                var set_url = url_api + 'news-create';
            }else{
                form.append('news_session',newsSession);
                var set_url = url_api + 'news-update';
                // var set_url = url_api + newsSession + '/news-update';
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
                        formReset();
                        if(newsSession == ''){
                            data_table.ajax.reload();
                        }else{
                            data_table.ajax.reload(null,false);
                        }
                        newsSession = r.news_session;
                        $("#modal_news").modal('hide');
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

        newsSession = $(this).attr('data-session');

        if(next){
            if (newsSession.length === 0) {
                next = false;
                notif(0,'Data tidak ada');
            }
        }

        if(next){
            let form = new FormData();
            form.append('action','read');
            form.append('news_session',newsSession);
            $.ajax({
                type: "get",
                url: url_api + newsSession+ '/news-data',
                // url:url,
                // data: form,
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
                        $("#modal_news").modal('show');
                        newsSession = r.news_session;
                        userSession = r.news_author;
                        $("#news_title").val(r.news_title);
                        if (r.news_publish_date) {
                            $("#news_publish_date")[0]._flatpickr.setDate(moment(r.news_publish_date).format('DD-MM-YYYY'));
                            // newsPublishDate.formatDate(r.news_publish_date, "DD-MM-YYYY");
                        }
                        if (r.news_expired_date) {
                            // newsExpiredDate.setDate(moment(r.news_expired_date).format('DD-MM-YYYY'));
                            // newsExpiredDate.formatDate(r.news_expired_date, "DD-MM-YYYY");
                            // $("#news_expired_date").val(moment(r.news_expired_date).format('DD-MM-YYYY'));
                            $("#news_expired_date")[0]._flatpickr.setDate(moment(r.news_expired_date).format('DD-MM-YYYY'));                            
                        }
                        $('input[name=news_status][value='+r.news_status+']').prop("checked", true).change();
                        ckClassicEditor.setData(r.news_content);

                        if(!r.rl_asset == undefined){
                            $("#files_preview").attr('src',url_image);
                        }else{
                            $("#files_preview").attr('src',r.rl_asset[0].asset_url);
                        }                        
                    }else{
                        notif(s,m);
                        newsSession = '';
                        userSession = '';
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
        newsSession = $(this).attr('data-session');
        var newsTitle = $(this).attr('data-name');

        let title   = 'Confirmation';
        let content = 'Are you sure to remove <b>'+newsTitle+'</b> ?';
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
                        if(!newsSession){
                            next = false;
                            notif(0,'Data tidak valid');
                        }

                        if(next){
                            let form = new FormData();
                            form.append('action','delete');
                            form.append('news_session',newsSession);
                            var set_url = url_api + 'news-delete';
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
    function formReset(){
        newsSession = '';
        $("#form_news input")
        .not("input[name='news_publish_date']").not("input[name='news_expired_date']").not("input[name='status']").val('');
        $("input[name=news_status][value=1]").prop("checked", true).change();
        $("#form_news select").val(0).trigger('change');
        $("#files_preview").attr('src', url_image);        
    }
    //Image Croppie
    // $(document).on('change', '#files', function(e) {
    //     if($("#files").val() == ''){
    //         $("#files_preview").attr('src', url_image);
    //         $("#files_link").attr('href', url_image);            
    //         $("#files_preview").attr('data-save-img', '');
    //         return;
    //     }
    //     var reader = new FileReader();
    //     reader.onload = function(e) {
    //         upload_crop_img.croppie('bind', {
    //             url: e.target.result
    //         }).then(function () {
    //             $("#modal_croppie").modal("show");
    //             setTimeout(function(){$('#modal_croppie_canvas').croppie('bind');}, 300);
    //         });
    //     };
    //     reader.readAsDataURL(this.files[0]);
    // });
    $(document).on('click', '#modal_croppie_cancel', function(e){
        e.preventDefault();
        e.stopPropagation();
        $("#files").val('');
        $("#files_preview").attr('data-save-img', '');
        $("#files_preview").attr('src', url_image);
        $("#files_link").attr('href', url_image);
    });
    $(document).on('click', '#modal_croppie_save', function(e){
        e.preventDefault();
        e.stopPropagation();
        upload_crop_img.croppie('result', {
            type: 'canvas',
            size: 'viewport',
        }).then(function (resp) {
            $("#files_preview").attr('src', resp);
            $("#files_link").attr('href', resp);
            $("#files_preview").attr('data-save-img', resp);
            $("#modal_croppie").modal("hide");
        });
    });
});
</script>