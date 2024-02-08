
<script>
    $(document).ready(function () {

        var url = "<?= base_url('news/manage'); ?>";
        // var url_image = '<?= base_url('assets/webarch/img/default-user-image.png'); ?>';
        var url_image = '<?= base_url('upload/noimage.png'); ?>';
        var url_preview = '<?php echo site_url(); ?>' + 'blog/';
        var view = "<?php echo $_view; ?>";
        $(".nav-tabs").find('li[class="active"]').removeClass('active');
        $(".nav-tabs").find('li[data-name="' + view + '"]').addClass('active');
        // console.log(view);
        $("#img-preview1").attr('src', url_image);
        $("select").select2();
        $(".date").datepicker({
            // defaultDate: new Date(),
            format: 'yyyy-mm-dd',
            autoclose: true,
            enableOnReadOnly: true,
            language: "id",
            todayHighlight: true,
            weekStart: 1
        });
        const autoNumericOption = {
            digitGroupSeparator: '.',
            decimalCharacter: ',',
            decimalCharacterAlternative: ',',
            decimalPlaces: 0,
            watchExternalChanges: true //!!!        
        };
        // new AutoNumeric('#harga_jual', autoNumericOption);
        // new AutoNumeric('#harga_beli', autoNumericOption);    
        // $('#content-description').summernote({
        //     placeholder: 'Content description here!',
        //     tabsize: 4,
        //     height: 350
        // });
        var index = $("#table-data").DataTable({
            // "processing": true,
            "serverSide": true,
            "ajax": {
                url: url,
                type: 'post',
                dataType: 'json',
                cache: 'false',
                data: function (d) {
                    d.action = 'load';
                    // d.tipe = identity;
                    // d.start = $("#table-data").attr('data-limit-start');
                    // d.length = $("#table-data").attr('data-limit-end');
                    d.tipe = 2;
                    d.length = $("#filter_length").find(':selected').val();
                    d.category = $("#filter_categories").find(':selected').val();
                    d.flag = $("#filter_flag").find(':selected').val();
                    d.search = {
                        value: $("#filter_search").val()
                    };
                },
                dataSrc: function (data) {
                    return data.result;
                }
            },
            "columnDefs": [
                {"targets": 0, "title": "Judul", "searchable": true, "orderable": false},
                {"targets": 1, "title": "Kategori", "searchable": true, "orderable": false},
                {"targets": 2, "title": "Konten Pesan", "searchable": true, "orderable": false},
                {"targets": 3, "title": "Status", "searchable": true, "orderable": false},
                {"targets": 4, "title": "Action", "searchable": true, "orderable": false, "className": 'dt-body-right'}
            ],
            "order": [
                [0, 'asc']
            ],
            "columns": [{
                    'data': 'news_title',
                    className: 'text-left',
                    render: function (data, meta, row) {
                        var dsp = '';
                        // dsp += '<button class="btn-edit btn btn-mini btn-primary" data-id="'+ row.news_id +'">';
                        // dsp += '<span class="fas fa-edit"></span>Edit';
                        // dsp += '</button>';
                        dsp += '<a href="#" class="btn-edit" data-id="' + row.news_id + '"><i class="fas fa-newspaper"></i>&nbsp;' + row.news_title + '</a>';
                        return dsp;
                    }
                }, {
                    'data': 'category_name'
                }, {
                    'data': 'news_content',
                    className: 'text-left',
                    render: function (data, meta, row) {
                        var dsp = row.news_content;
                        if (dsp.length > 10) {
                            dsp.substring(0, 10);
                        }
                        return dsp;
                    }
                }, {
                    'data': 'news_flag',
                    className: 'text-left',
                    render: function (data, meta, row) {
                        if (parseInt(row.news_flag) == 1) {
                            return 'Aktif';
                        } else if (parseInt(row.news_flag) == 0) {
                            return 'Nonaktif';
                        } else {
                            return 'Terhapus';
                        }
                    }
                }, {
                    'data': 'news_id',
                    className: 'text-left',
                    render: function (data, meta, row) {
                        var dsp = '';
                        // dsp += '&nbsp;<button class="btn btn-edit btn-mini btn-primary"';
                        // dsp += 'data-nama="' + row.news_title + '" data-url="' + row.news_url + '" data-id="' + data + '" data-flag="' + row.news_flag + '" data-category="' + row.category_url + '">';
                        // dsp += '<span class="fas fa-edit"></span> Edit</button>';

                        // dsp += '&nbsp;<button class="btn btn-preview btn-mini btn-info"';
                        // dsp += 'data-nama="'+row.news_title+'" data-url="'+row.news_url+'" data-id="'+data+'" data-flag="'+row.news_flag+'" data-category="'+row.category_url+'">';
                        // dsp += '<span class="fas fa-eye"></span> Preview</button>';

                        // if (parseInt(row.news_flag) === 0) {
                        //     dsp += '&nbsp;<button class="btn btn-set-active btn-mini btn-success"';
                        //     dsp += 'data-nama="' + row.news_title + '" data-kode="' + row.news_title + '" data-id="' + data + '" data-flag="' + row.news_flag + '">';
                        //     dsp += '<span class="fas fa-check-square primary"></span> Aktifkan</button>';
                        // } else {
                        //     dsp += '&nbsp;<button class="btn btn-set-active btn-mini btn-danger"';
                        //     dsp += 'data-nama="' + row.news_title + '" data-kode="' + row.news_title + '" data-id="' + data + '" data-flag="' + row.news_flag + '">';
                        //     dsp += '<span class="fas fa-times danger"></span> Nonaktifkan</button>';
                        // }

                        var dsp = ''; var label = 'Error Status'; var icon = 'fas fa-cog'; var color = 'white'; var bgcolor = '#d1dade';
                        if(parseInt(row.news_flag) == 1){
                            //  dsp += '<label style="color:#6273df;">Aktif</label>';
                            label = 'Aktif';
                            icon = 'fas fa-lock';
                            bgcolor = '#0090d9';
                        }else if(parseInt(row.news_flag) == 4){
                            //  dsp += '<label style="color:#ff194f;">Terhapus</label>';
                            label = 'Terhapus';
                            icon = 'fas fa-trash';
                            bgcolor = '#f35958';
                        }else if(parseInt(row.news_flag) == 0){
                            //   dsp += '<label style="color:#ff9019;">Nonaktif</label>';
                            label = 'Nonaktif';
                            icon = 'fas fa-unlock';
                            // color = 'green';
                            bgcolor = '#ff9019';
                        }                        

                       /* Button Action Concept 2 */
                       dsp += '<div class="btn-group">';
                       // dsp += '    <button class="btn btn-mini btn-default" style="background-color:'+bgcolor+';color:'+color+'"><span class="'+icon+'"></span> '+label+'</button>';
                       dsp += '    <button class="btn btn-mini btn-default dropdown-toggle btn-demo-space" style="background-color:'+bgcolor+';color:'+color+';" data-toggle="dropdown" aria-expanded="true"><span class="'+icon+'"></span> '+label+' <span class="caret" style="color:'+color+'"></span> </button>';
                       dsp += '    <ul class="dropdown-menu">';
                                dsp += '        <li>';
                                dsp += '            <a class="btn-edit" style="cursor:pointer;"';
                                dsp += '                data-nama="' + row.news_title + '" data-url="' + row.news_url + '" data-id="' + data + '" data-flag="' + row.news_flag + '" data-category="' + row.category_url + '">';
                                dsp += '                <span class="fas fa-edit"></span> Edit';
                                dsp += '            </a>';
                                dsp += '        </li>';                       
                                dsp += '        <li>';
                                dsp += '            <a class="btn-preview" style="cursor:pointer;"';
                                dsp += '                data-nama="' + row.news_title + '" data-url="' + row.news_url + '" data-id="' + data + '" data-flag="' + row.news_flag + '" data-category="' + row.category_url + '">';
                                dsp += '                <span class="fas fa-eye"></span> Preview';
                                dsp += '            </a>';
                                dsp += '        </li>';
                       if(parseInt(row.news_flag) == 1){
                               dsp += '<li>';
                               dsp += '    <a class="btn_update_flag_news" style="cursor:pointer;"';
                               dsp += '        data-news-id="'+data+'" data-news-code="'+row.news_title+'" data-news-flag="0" data-news-session="'+row.news_title+'">';
                               dsp += '        <span class="fas fa-ban"></span> Nonaktifkan';
                               dsp += '    </a>';
                               dsp += '</li>';
                       }else if(parseInt(row.news_flag) == 0) {
                               dsp += '<li>'; 
                               dsp += '    <a class="btn_update_flag_news" style="cursor:pointer;"';
                               dsp += '        data-news-id="'+data+'" data-news-code="'+row.news_title+'" data-news-flag="1" data-news-session="'+row.news_title+'">';
                               dsp += '        <span class="fas fa-lock"></span> Aktifkan';
                               dsp += '    </a>';
                               dsp += '</li>';
                       }
                               dsp += '<li>';
                               dsp += '    <a class="btn_update_flag_news" style="cursor:pointer;"';
                               dsp += '        data-news-id="'+data+'" data-news-code="'+row.news_title+'" data-news-flag="4" data-news-session="'+row.news_title+'">';
                               dsp += '        <span class="fas fa-trash"></span> Hapus';
                               dsp += '    </a>';
                               dsp += '</li>';                       
                       dsp += '    </ul>';
                       dsp += '</div>';

                        return dsp;
                    }
                }]
        });
        $('#table-data').on('page.dt', function () {
            var info = index.page.info();
            // console.log( 'Showing page: '+info.page+' of '+info.pages);
            var limit_start = info.start;
            var limit_end = info.end;
            var length = info.length;
            var page = info.page;
            var pages = info.pages;
            console.log(limit_start, limit_end);
            $("#table-data").attr('data-limit-start', limit_start);
            $("#table-data").attr('data-limit-end', limit_end);
        });
        //Datatable Config
        $("#table-data_filter").css('display', 'none');
        $("#table-data_length").css('display', 'none');
        $("#filter_length").on('change', function (e) {
            var value = $(this).find(':selected').val();
            $('select[name="table-data_length"]').val(value).trigger('change');
            index.ajax.reload();
        });
        $("#filter_search").on('input', function (e) {
            var ln = $(this).val().length;
            if (parseInt(ln) > 3) {
                index.ajax.reload();
            }
        });

        $('#categories').select2({
            placeholder: '--- Pilih ---',
            minimumInputLength: 0,
            ajax: {
                type: "get",
                url: "<?= base_url('search/manage'); ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term,
                        tipe: 2, //1=Produk, 2=News
                        source: 'categories'
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            templateSelection: function (data, container) {
                // Add custom attributes to the <option> tag for the selected option
                // $(data.element).attr('data-custom-attribute', data.customValue);
                // $("input[name='satuan']").val(data.satuan);
                return data.text;
            }
        });
        $('#filter_categories').select2({
            placeholder: '--- Pilih ---',
            minimumInputLength: 0,
            ajax: {
                type: "get",
                url: "<?= base_url('search/manage'); ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term,
                        tipe: 2, //1=Produk, 2=News
                        source: 'categories'
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            templateSelection: function (data, container) {
                // Add custom attributes to the <option> tag for the selected option
                // $(data.element).attr('data-custom-attribute', data.customValue);
                // $("input[name='satuan']").val(data.satuan);
                return data.text;
            }
        });
        $(document).on("change", "#filter_categories", function (e) {
            index.ajax.reload();
        });
        $(document).on("change", "#filter_flag", function (e) {
            index.ajax.reload();
        });

        // Save Button
        $(document).on("click", "#btn-save", function (e) {
            e.preventDefault();
            var next = true;

            if (next == true) {
                if ($("input[id='title']").val().length == 0) {
                    notif(0, 'Judul wajib diisi');
                    $("#title").focus();
                    next = false;
                }
            }

            if (next == true) {
                if ($("select[id='categories']").find(':selected').val() == 0) {
                    notif(0, 'Kategori wajib dipilih');
                    next = false;
                }
            }

            if (next == true) {
                // var prepare = {
                //   title: $("input[id='title']").val(),
                //   tags: $("input[id='tags']").val(),
                //   keywords: $("input[id='keywords']").val(),
                //   url: $("input[id='url']").val(),                
                //   content: $("textarea[id='content']").val(),
                //   categories: $("select[id='categories']").find(':selected').val(),
                //   status: $("select[id='status']").find(':selected').val()
                // }
                var form = new FormData();
                form.append('action', 'create');
                form.append('tipe', 2);
                form.append('upload1', $('#upload1')[0].files[0]);
                form.append('categories', $('#categories').find(':selected').val());
                form.append('status', $('#status').find(':selected').val());
                form.append('title', $('#title').val());
                form.append('content', $('#content-description').val());
                // var prepare_data = JSON.stringify(formData);
                // var data = {
                //   action: 'create',
                //   data: prepare_data
                // };
                // console.log(data);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {},
                    success: function (d) {
                        if (parseInt(d.status) == 1) { /* Success Message */
                            notif(1, d.message);
                            index.ajax.reload();
                        } else { //Error
                            notif(0, d.message);
                        }
                    },
                    error: function (xhr, Status, err) {
                        notif(0, 'Error');
                    }
                });
            }
        });

        // Edit Button
        $(document).on("click", ".btn-edit", function (e) {
            formMasterSetDisplay(0);
            $("#form-master input[name='kode']").attr('readonly', true);

            e.preventDefault();
            var id = $(this).data("id");
            var data = {
                action: 'read',
                id: id
            }
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: 'json',
                cache: false,
                beforeSend: function () {},
                success: function (d) {
                    if (parseInt(d.status) == 1) { /* Success Message */
                        $("#div-form-trans").show(300);
                        // activeTab('tab1'); // Open/Close Tab By ID
                        // notif(1,d.result.id);ss
                        $("#form-master input[name='id_document']").val(d.result.news_id);
                        $("#form-master input[name='title']").val(d.result.news_title);
                        $("#form-master textarea[name='content-description']").val(d.result.news_content);
                        // var markupStr = d.result.news_content;
                        // $('#content-description').summernote('code', markupStr);

                        //News Image
                        if (d.result.news_images == undefined) {
                            $('#img-preview1').attr('src', url_image);
                        } else {
                            var image = "<?php echo site_url(); ?>" + d.result.news_image;
                            $('#img-preview1').attr('src', image);
                        }

                        $("#form-master select[name='status']").val(d.result.news_flag).trigger('change');
                        $("select[name='categories']").append('' +
                                '<option value="' + d.result.category_id + '">' +
                                d.result.category_name +
                                '</option>');
                        $("select[name='categories']").val(d.result.category_id).trigger('change');

                        $("#btn-new").hide();
                        $("#btn-save").hide();
                        $("#btn-update").show();
                        $("#btn-cancel").show();
                        scrollUp('content');
                    } else {
                        notif(0, d.message);
                    }
                },
                error: function (xhr, Status, err) {
                    notif(0, 'Error');
                }
            });
        });

        // Update Button
        $(document).on("click", "#btn-update", function (e) {
            e.preventDefault();
            var next = true;
            var id = $("#form-master input[name='id_dokumen']").val();
            var title = $("#form-master input[name='title']");

            if (id == '') {
                notif(0, 'ID tidak ditemukan');
                next = false;
            }

            if (title.val().length == 0) {
                notif(0, 'Title wajib diisi');
                title.focus();
                next = false;
            }

            if (next == true) {
                if ($("select[id='categories']").find(':selected').val() == 0) {
                    notif(0, 'Categories wajib dipilih');
                    next = false;
                }
            }

            if (next == true) {
                // var prepare = {
                //   id: $("input[id=id_document]").val(),
                //   title: $("input[id='title']").val(),
                //   tags: $("input[id='tags']").val(),
                //   keywords: $("input[id='keywords']").val(),
                //   url: $("input[id='url']").val(),                
                //   content: $("textarea[id='content-description']").val(),
                //   categories: $("select[id='categories']").find(':selected').val(),
                //   status: $("select[id='status']").find(':selected').val()
                // }      
                var formDataUpdate = new FormData();
                formDataUpdate.append('action', 'update');
                formDataUpdate.append('id', $('#id_document').val());
                formDataUpdate.append('upload1', $('#upload1')[0].files[0]);
                formDataUpdate.append('categories', $('#categories').find(':selected').val());
                formDataUpdate.append('status', $('#status').find(':selected').val());
                formDataUpdate.append('title', $('#title').val());
                formDataUpdate.append('content', $('#content-description').val());
                // var prepare_data = JSON.stringify(prepare);
                // var data = {
                //   action: 'update',
                //   data: prepare_data
                // };
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formDataUpdate,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {},
                    success: function (d) {
                        if (parseInt(d.status) == 1) {
                            $("#btn-new").show();
                            $("#btn-save").hide();
                            $("#btn-update").hide();
                            $("#btn-cancel").hide();
                            $("#form-master input").val();
                            formMasterSetDisplay(1);
                            notif(1, d.message);
                            index.ajax.reload(null, false);
                        } else {
                            notif(0, d.message);
                        }
                    },
                    error: function (xhr, Status, err) {
                        notif(0, 'Error');
                    }
                });
            }

        });

        // Delete Button
        $(document).on("click", ".btn-delete", function () {
            event.preventDefault();
            var id = $(this).attr("data-id");
            var kode = $(this).attr("data-kode");
            var user = $(this).attr("data-nama");
            $.confirm({
                title: 'Hapus!',
                content: 'Apakah anda ingin menghapus <b>' + user + '</b> ?',
                buttons: {
                    confirm: {
                        btnClass: 'btn-danger',
                        text: 'Ya',
                        action: function () {
                            var data = {
                                action: 'remove',
                                id: id
                            }
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: data,
                                success: function (d) {
                                    if (parseInt(d.status) = 1) {
                                        notif(1, d.message);
                                        index.ajax.reload(null, false);
                                    } else {
                                        notif(0, d.message);
                                    }
                                }
                            });
                        }
                    },
                    cancel: {
                        btnClass: 'btn-success',
                        text: 'Batal',
                        action: function () {
                            // $.alert('Canceled!');
                        }
                    }
                }
            });
        });

        // Set Flag Button
        $(document).on("click", ".btn-set-active", function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var flag = $(this).attr("data-flag");
            if (flag == 1) {
                var set_flag = 0;
                var msg = 'non publikasi';
            } else {
                var set_flag = 1;
                var msg = 'publikasikan';
            }
            var kode = $(this).attr("data-kode");
            var nama = $(this).attr("data-nama");
            $.confirm({
                title: 'Set Status',
                content: 'Apakah anda ingin <b>' + msg + '</b> dengan judul <b>' + nama + '</b> ?',
                columnClass: 'col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',
                autoClose: 'button_2|10000',
                closeIcon: true,
                closeIconClass: 'fas fa-times',
                buttons: {
                    button_1: {
                        text: 'Ok',
                        btnClass: 'btn-primary',
                        keys: ['enter'],
                        action: function () {
                            var data = {
                                action: 'set-active',
                                id: id,
                                flag: set_flag,
                                nama: nama,
                                kode: kode
                            }
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: data,
                                dataType: 'json',
                                cache: false,
                                beforeSend: function () {},
                                success: function (d) {
                                    if (parseInt(d.status) == 1) {
                                        notif(1, d.message);
                                        index.ajax.reload(null, false);
                                    } else {
                                        notif(0, d.message);
                                    }
                                },
                                error: function (xhr, Status, err) {
                                    notif(0, 'Error');
                                }
                            });
                        }
                    },
                    button_2: {
                        text: 'Batal',
                        btnClass: 'btn-danger',
                        keys: ['Escape'],
                        action: function () {
                            //Close
                        }
                    }
                }
            });
        });

        // Set Preview
        $(document).on("click", ".btn-preview", function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var title = $(this).attr("data-title");
            var urls = $(this).attr("data-url");
            var category = $(this).attr("data-category");
            var final_url = category + '/' + urls;
            // console.log(final_url);
            // $.alert('Harusnya Redirect to '+url_preview+urls);
            // window.open(url_preview+urls);
            $.confirm({
                title: 'Pengalihan Halaman',
                content: 'Anda akan diarahkan ke halaman <b>' + url_preview + final_url + '</b>',
                columnClass: 'col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',
                autoClose: 'button_2|10000',
                closeIcon: true,
                closeIconClass: 'fas fa-times',
                buttons: {
                    button_1: {
                        text: 'Lanjutkan',
                        btnClass: 'btn-primary',
                        keys: ['enter'],
                        action: function () {
                            window.open(url_preview + final_url);
                        }
                    },
                    button_2: {
                        text: 'Tutup',
                        btnClass: 'btn-danger',
                        keys: ['Escape'],
                        action: function () {
                            //Close
                        }
                    }
                }
            });

        });

        $(document).on("click", "#btn-new", function (e) {
            formNew();
            // $("#div-form-trans").show(300);
            $("#div-form-trans").show(300);
            $(this).hide();
            // animateCSS('#btn-new', 'backOutLeft','true');

            // btnNew.classList.add('animate__animated', 'animate__fadeOutRight');
        });
        // Cancel Button
        $(document).on("click", "#btn-cancel", function (e) {
            e.preventDefault();
            $("#btn-new").css('display', 'inline');
            // formTransCancel();
            // btnNew.classList.remove('animate__animated', 'animate__fadeOutRight');    
            $("#div-form-trans").hide(300);
        });

        $(document).on("click",".btn_update_flag_news",function(e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            var next     = true;
            var id       = $(this).attr('data-news-id');
            // var session  = $(this).attr('data-news-session');
            var name     = $(this).attr('data-news-code');
            var flag     = $(this).attr('data-news-flag');

            if(parseInt(flag) == 0){
                var set_flag = 0;
                var msg = 'menonaktifkan';
            }else if(parseInt(flag) == 1){
                var set_flag = 1;
                var msg = 'mengaktifkan';
            }else{
                var set_flag = 4;
                var msg = 'menghapus';
            }

            $.confirm({
                title: 'Konfirmasi!',
                content: 'Apakah anda ingin '+msg+' <b>'+name+'</b> ?',
                buttons: {
                    confirm:{ 
                        btnClass: 'btn-danger',
                        text: 'Ya',
                        action: function () {
                            
                            var form = new FormData();
                            form.append('action', 'update_flag');
                            form.append('news_id', id);
                            // form.append('voucher_session', session);
                            form.append('news_name', name);
                            form.append('news_flag', set_flag);

                            $.ajax({
                                type: "POST",
                                url : url,
                                data: form,
                                dataType:'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success:function(d){
                                    if(parseInt(d.status)==1){ 
                                        notif(d.status,d.message); 
                                        voucher_table.ajax.reload(null,false);
                                    }else{ 
                                        notif(d.status,d.message); 
                                    }
                                }
                            });
                        }
                    },
                    cancel:{
                        btnClass: 'btn-success',
                        text: 'Batal', 
                        action: function () {
                            // $.alert('Canceled!');
                        }
                    }
                }
            });
        });

        $('#upload1').change(function (e) {
            var fileName = e.target.files[0].name;
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-preview1').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
        // function readURL(input) {
        //   if (input.files && input.files[0]) {
        //     var reader = new FileReader();
        //     reader.onload = function (e) {
        //         $('.uploadpdf').text(input.files[0].name);
        //     }
        //     reader.readAsDataURL(input.files[0]);
        //   }
        // }  
    });

    function formNew() {
        formMasterSetDisplay(0);
        $("#form-master input").val();
        $("#btn-new").hide();
        $("#btn-save").show();
        $("#btn-cancel").show();
    }
    function formCancel() {
        formMasterSetDisplay(1);
        $("#form-master input").val();
        $("#btn-new").show();
        $("#btn-save").hide();
        $("#btn-update").hide();
        $("#btn-cancel").hide();
    }
    function formMasterSetDisplay(value) { // 1 = Untuk Enable/ ditampilkan, 0 = Disabled/ disembunyikan
        if (value == 1) {
            var flag = true;
        } else {
            var flag = false;
        }
        //Attr Input yang perlu di setel
        var form = '#form-master';
        var attrInput = [
            "title",
        ];

        for (var i = 0; i <= attrInput.length; i++) {
            $("" + form + " input[name='" + attrInput[i] + "']").attr('readonly', flag);
        }

        //Attr Textarea yang perlu di setel
        var attrText = [
            "content-description"
        ];
        for (var i = 0; i <= attrText.length; i++) {
            $("" + form + " textarea[name='" + attrText[i] + "']").attr('readonly', flag);
        }

        //Attr Select yang perlu di setel
        var atributSelect = [
            "categories",
            "status",
        ];
        for (var i = 0; i <= atributSelect.length; i++) {
            $("" + form + " select[name='" + atributSelect[i] + "']").attr('disabled', flag);
        }
    }
</script>