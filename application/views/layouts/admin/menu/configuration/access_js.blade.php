<script type="text/javascript">
$(document).ready(function() {  
    

    let url = '{{ url('/') }}/config/menu/access';
    let url_search = '{{ url('/') }}/search';    
    let csrf_token = $('meta[name="csrf-token"]').attr('content')
    // let bearer_token = "{{ $data['session']['token'] }}";

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
    
    $(function(){
        $("#v-pills-1-tab").trigger('click');
    });
// $("#form_order :input")                 // All input on <form id="form_order">
// $("#form_order :checkbox")              // All input on <form id="form_order">
// $("#form_order :radio")                 // All input on <form id="form_order">
// $("#form_order :input[data-id='1']")    // All input on <form id="form_order"> with attribute data-id="1"
// $("input[data-id='1']")                 // All input with attribute data-id="1"
// $("input[name='order_branch']:checked") // Check Radio is checked                       

// $("[name|='order_branch'][value='1']")   // All attribute 'name' contain text start 'order_branch' with value=1
// $("[class|='order_branch'][value='1']")   // All attribute 'class' contain text start 'order_branch' with value=1
// $("[class*='order_branch'][value='1']")   // All attribute 'class' contain text 'order_branch' with value=1

// $(".intro, .demo")                          // All class 'intro' or 'demo'
// $("[href]")	                           // All elements with a href attribute
// $("[href!='demo.html']")	               // All elements with a href attribute value not equal to "default.htm"
// $("[href$='.jpg']")	                   // All elements with a href attribute value ending with ".jpg"

    $("[name*='nav-custom']").on('click', function(e) {
    // $("[class|'='nav-link'][data-bs-toggle='pill']").on('click', function(e) {        
        var id = $(this).attr('data-id');
        let form = new FormData();
        form.append('action', 'load_access');
        form.append('access_id',id);        
        $.ajax({
            type: "post",
            url: url,
            data: form, 
            dataType: 'json', cache: 'false', 
            contentType: false, processData: false,
            beforeSend:function(x){
                x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
                $(".table_temporary tbody").html('<tr><td colspan="5"><span class="fas fa-spinner fa-spin"></span> Loading...</td></tr>');
            },
            success:function(d){
                let s = d.status;
                let m = d.message;
                let r = d.result;
                if(parseInt(s) == 1){
                    notif(s,m);
                    
                    let r = d.result;
                    let total_records = d.total_records;
                    if(parseInt(total_records) > 0){
                        // $("#.table_temporary[data-id="+id+"] tbody").html('');
                        let dsp = '';
                        for(let a=0; a < total_records; a++) {
                            let value = r[a];
                            let chk_write = '', chk_read = '', chk_modify = '', chk_delete = '', menu_name = '', set_icon = '<i class="ri-separator"></i>';
                            if(value['ACCESS_READ'] == 1){
                                chk_read = ' checked';
                            }

                            if(value['ACCESS_WRITE'] == 1){
                                chk_write = ' checked';
                            }

                            if(value['ACCESS_MODIFY'] == 1){
                                chk_modify = ' checked';
                            }

                            if(value['ACCESS_DELETE'] == 1){
                                chk_delete = ' checked';
                            }   

                            if(value['MENU_ICON'] != undefined){
                                set_icon = '<i class="'+value['MENU_ICON']+'"></i>';
                            }   

                            var menu_id = 0;
                            if(value['MENU_CHILD_ID'] > 0){
                                menu_id = value['MENU_CHILD_ID'];
                                menu_name = '&nbsp;&nbsp;&nbsp;&nbsp;'+set_icon + '&nbsp;&nbsp;' + value['MENU_CHILD_NAME'];
                            }else{
                                menu_id = value['MENU_PARENT_ID'];                                
                                menu_name = set_icon + '&nbsp;&nbsp;' + value['MENU_PARENT_NAME'];
                            }
                            
                            var set_attr = "data-menu-id="+menu_id+" data-level-id="+value['LEVEL_ID']+"";

                            dsp += `<tr>
                                <th scope="row"><a href="#" class="fw-medium">${menu_name}</a></th>
                                <td style="text-align:left;">
                                    <div class="form-check form-switch form-switch-md form-switch-success mb-3" dir="ltr">
                                        <input name="checkbox" type="checkbox" ${set_attr} data-access-type="1" class="form-check-input" ${chk_read}>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch form-switch-md form-switch-success mb-3" dir="ltr">
                                        <input name="checkbox" type="checkbox" ${set_attr} data-access-type="2" class="form-check-input" ${chk_write}>
                                    </div>                                                    
                                </td>
                                <td>
                                    <div class="form-check form-switch form-switch-md form-switch-success mb-3" dir="ltr">
                                        <input name="checkbox" type="checkbox" ${set_attr} data-access-type="3" class="form-check-input" ${chk_modify}>
                                    </div>                                                    
                                </td>
                                <td>
                                    <div class="form-check form-switch form-switch-md form-switch-success mb-3" dir="ltr">
                                        <input name="checkbox" type="checkbox" ${set_attr} data-access-type="4" class="form-check-input" ${chk_delete}>
                                    </div>                                                    
                                </td>
                            </tr>`;
                            // console.log(dsp);
                        }
                        $(".table_temporary tbody").html(dsp);
                    }
                }else{
                    notif(s,m);
                }
            },
            error:function(xhr,status,err){
                notif(0,err);
            }
        });
    });

    $(document).on('change', 'input:checkbox[name="checkbox"]', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var menu = $(this).attr('data-menu-id');
        var access = $(this).attr('data-access-type');   
        var level = $(this).attr('data-level-id');                
        // console.log(menu_id,access);

        // $(this).removeAttr('checked');
        // $(this).attr('checked', 'checked');

        let form = new FormData();
        form.append('action', 'update');
        form.append('menu_id',menu);
        form.append('access_type',access);   
        form.append('level_id',level);                   
        form.append('access_status',($(this).is(":checked") == true) ? 1 : 0);         
        $.ajax({
            type: "post",
            url: url,
            data: form, 
            dataType: 'json', cache: 'false', 
            contentType: false, processData: false,
            beforeSend:function(x){
                // x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
            },
            success:function(d){
                let s = d.status;
                let m = d.message;
                let r = d.result;
                if(parseInt(s) == 1){
                    notif(s,m);
                    /* hint zz_for or zz_each */
                    
                }else{
                    notif(s,m);
                }
            },
            error:function(xhr,status,err){
                notif(0,err);
            }
        });
    });
}); 
</script>