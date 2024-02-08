<style>
    .scroll {
        margin-top: 4px;
        margin-bottom: 8px;
        margin-left: 4px;
        margin-right: 4px;
        padding: 4px;
        /*background-color: green; */
        width: 100%;
        height: 200px;
        overflow-x: hidden;
        overflow-y: auto;
        text-align: justify;
    }
    /* Large desktops and laptops */
    @media (min-width: 1200px) {
        .table-responsive{
            overflow-x: unset;
        }
    }

    /* Landscape tablets and medium desktops */
    @media (min-width: 992px) and (max-width: 1199px) {
        .table-responsive{
            overflow-x: unset;
        }
    }

    /* Portrait tablets and small desktops */
    @media (min-width: 768px) and (max-width: 991px) {
        .table-responsive{
            overflow-x: unset;
        }
    }

    /* Landscape phones and portrait tablets */
    @media (max-width: 767px) {
        .table-responsive{
            overflow-x: unset;
        }
    }

    /* Portrait phones and smaller */
    @media (max-width: 480px) {
        .tab-content > .active{
            padding: 8px!important;
        }  
        .padding-remove-left, .padding-remove-right{
            padding-left:0px!important;
            padding-right:0px!important;    
        }
        .padding-remove-side{
            padding-left: 5px!important;
            padding-right: 5px!important;
        }
        .form-label{
            /*padding-left: 5px!important;*/
        }
        .prs-0{
            padding-left: 0px!important;
            padding-right: 0px!important;    
        }
        .prs-0 > label{
            padding-left: 5px!important;
            padding-right: 5px!important;    
        }
        .prs-0 > div{
            /*padding-left: 5px!important;*/
            /*padding-right: 5px!important;    */
        }
        .prs-0 > input{
            margin-left: 0px!important;
            margin-right: 0px!important;    
        }
        .prs-0 > select{
            margin-left: 5px!important;
            margin-right: 5px!important;    
        }

        .prs-5{
            padding-left: 5px!important;
            padding-right: 5px!important;    
        }
        .prs-5 > label{
            padding-left: 5px!important;
            padding-right: 5px!important;    
        }
        .prs-5 > div{
            /*padding-left: 5px!important;*/
            /*padding-right: 5px!important;    */
        }
        .prs-5 > input{
            margin-left: 5px!important;
            margin-right: 5px!important;    
        }
        .prs-5 > select{
            margin-left: 5px!important;
            margin-right: 5px!important;    
        }    

        .prl-2{
            padding-left: 2.5px!important;
        }
        .prr-2{
            padding-right: 2.5px!important;
        } 
        .prl-5{
            padding-left: 5px!important;
        }
        .prr-5{
            padding-right: 5px!important;
        }            
    }    
</style>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php include '_navigation.php'; ?>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side prs-0">
                    <div id="div-form-trans" style="display: none;" class="col-md-12 col-sm-12 col-xs-12 padding-remove-side prs-0">
                        <div class="grid simple">
                            <div class="grid-body">
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side prs-0">
                                    <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side prs-0">
                                        <div class="grid simple">
                                            <div class="grid-body">
                                                <div class="col-md-6 col-xs-12 col-sm-12" style="padding-left: 0;">
                                                    <h5><b><?php echo $title; ?></b></h5>
                                                </div>
                                                <div class="col-md-6 col-xs-12 col-sm-12 padding-remove-right">
                                                    <div class="pull-right">
                                                        <button id="btn-help" onClick="" class="hide btn btn-default btn-small" type="button"
                                                                style="display: none;">
                                                            <i class="fas fa-hands-helping"></i>
                                                            Lihat Tutorial
                                                        </button> 
                                                        <button id="btn-cancel" class="btn btn-default btn-small" type="reset"
                                                                style="display: inline;">
                                                            <i class="fas fa-times"></i>
                                                            Tutup
                                                        </button>                            
                                                    </div>
                                                </div>        
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side prs-0">
                                                        <form id="form-trans" name="form-trans" method="" action="">
                                                            <input id="tipe" type="hidden" value="<?php echo $identity; ?>">
                                                            <div class="col-md-12">
                                                                <input id="id_document" name="id_document" type="hidden" value="0" placeholder="id" readonly>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="col-md-4 col-sm-12 col-xs-12 padding-remove-left prs-0">
                                                                    <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side prs-0">
                                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Karyawan Pelaksana *</label>
                                                                                <select id="kontak" name="kontak" class="form-control" disabled readonly>
                                                                                    <option value="0">-- Pilih / Cari --</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                    
                                                                </div>
                                                                <div class="col-md-4 col-sm-12 col-xs-12 prs-0">
                                                                    <div class="col-md-12 col-xs-6 col-sm-6 padding-remove-left prs-0">
                                                                        <div class="col-md-12 col-xs-12 form-group prs-0">
                                                                            <label class="form-label">Tanggal Transaksi</label>
                                                                            <div class="col-md-12 col-sm-12 padding-remove-side">
                                                                                <div class="input-append success date col-md-12 col-lg-12 no-padding">
                                                                                    <input name="tgl" id="tgl" type="text" class="form-control" readonly="true"
                                                                                           value="<?php echo $end_date; ?>" data-value="">
                                                                                    <span class="add-on date-add"><i class="fas fa-calendar-alt"></i></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-left prs-0">
                                                                        <div class="col-md-12 col-xs-12 col-sm-12 form-group prs-5">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Gudang Pengambilan Stok</label>
                                                                                <select id="gudang" name="gudang" class="form-control" disabled readonly>
                                                                                    <option value="0">-- Pilih / Cari --</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                                                         
                                                                </div>
                                                                <div class="col-md-4 col-sm-12 col-xs-12 padding-remove-right">
                                                                    <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">
                                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-left">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Nomor Dokumen *</label>
                                                                                <input id="nomor" name="nomor" type="text" value="" class="form-control" placeholder="Otomatis jika dikosongkan" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side prs-0">
                                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-left prs-5">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Gudang Penempatan Stok</label>
                                                                                <select id="gudang_to" name="gudang_to" class="form-control" disabled readonly>
                                                                                    <option value="0">-- Pilih / Cari --</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                     
                                                                </div>            
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side prs-0">
                                    <div class="grid simple">
                                        <div class="hidden grid-title">
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"></a>
                                                <a href="#grid-config" data-toggle="modal" class="config"></a>
                                                <a href="javascript:;" class="reload"></a>
                                                <a href="javascript:;" class="remove"></a>
                                            </div>
                                        </div>
                                        <div class="grid-body">
                                            <h5><b>Daftar Item <?php echo $title; ?></b></h5>
                                            <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side">
                                                <form id="form-trans-item" name="form-trans-item" method="" action="">
                                                    <div class="col-md-12">
                                                        <input id="id_document_item" name="id_document_item" type="hidden" value="" placeholder="id" readonly>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side prs-0">
                                                        <div class="col-md-5 col-xs-12 col-sm-12 padding-remove-side prs-0">
                                                            <div class="form-group">
                                                                <label>Produk *</label>
                                                                <select id="produk" name="produk" class="form-control" disabled readonly>
                                                                    <option value="0">-- Pilih / Cari --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7 col-xs-12 col-sm-12 padding-remove-side prs-0">
                                                            <div class="col-md-3 col-xs-4 col-sm-4 prs-0 prr-2">
                                                                <div class="form-group">
                                                                    <label>Stok Saat Ini</label>
                                                                    <input id="stok" name="stok" type="text" value="" class="form-control"
                                                                           readonly='true'/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-xs-4 col-sm-4 prs-0 prr-2">
                                                                <div class="form-group">
                                                                    <label>Satuan</label>
                                                                    <input id="satuan" name="satuan" type="text" value="" class="form-control"
                                                                           readonly='true'/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-xs-4 col-sm-4 padding-remove-left prs-0">
                                                                <div class="form-group">
                                                                    <label>Qty</label>
                                                                    <input id="qty" name="qty" type="text" value="1" class="form-control" readonly='true' />
                                                                </div>
                                                            </div>                                                                                   
                                                            <div class="col-md-2 col-xs-12 col-sm-12 padding-remove-left">
                                                                <div class="form-group">
                                                                    <button id="btn-save-item" onClick="" class="btn btn-default btn-small" type="button"
                                                                            style="margin-top:22px;">
                                                                        <i class="fas fa-plus-square"></i>
                                                                        Tambah
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </form>
                                            </div>                      
                                            <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side scroll">
                                                <div class="table-responsive">
                                                    <table id="table-item" class="table table-bordered" data-limit-start="0" data-limit-end="10">
                                                        <thead>
                                                            <tr>
                                                                <th>Produk</th>
                                                                <th style="text-align:right;">Qty / Unit</th>
                                                                <th style="text-align:right;">Total</th>
                                                                <th style="text-align:left;">Gudang Asal</th>
                                                                <th style="text-align:left;">Gudang Tujuan</th>                              
                                                                <th>#</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side prs-0">
                                                <div class="col-md-6 col-xs-12 col-sm-12 padding-remove-side prs-0">
                                                    <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side prs-0" style="margin-bottom:4px;">
                                                        <div class="form-group">
                                                            <label class="col-md-5 form-label padding-remove-side prs-0">Total Produk</label>
                                                            <div class="col-md-7 prs-0">
                                                                <input id="total_produk" name="total_produk" type="text" value="0" class="form-control"
                                                                       style="text-align:right;" readonly='true' />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--
                                                    <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side" style="margin-bottom:4px;">
                                                      <div class="form-group">
                                                        <label class="col-md-5">Diskon %</label>
                                                        <div class="col-md-7">
                                                          <input id="diskon" name="diskon" type="text" value="0" class="form-control" style="cursor:pointer;text-align:right;" readonly='true'/>
                                                        </div>
                                                      </div>                            
                                                    </div>
                                                    -->
                                                    <div class="col-md-12-col-xs-12 col-sm-12 padding-remove-left prs-0">
                                                        <div class="form-group">
                                                            <label class="form-label">Keterangan</label>
                                                            <textarea id="keterangan" name="keterangan" type="text" value="" class="form-control" rows="4"></textarea>
                                                        </div>
                                                    </div>   
                                                    <!-- Start of Approval & Attachment -->
                                                    <?php if(($module_approval == 1) or ($module_attachment == 1)){ ?>
                                                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 padding-remove-left prs-0">
                                                        <?php if($module_approval == 1){ ?>
                                                        <div class="panel-group" id="accordion" data-toggle="collapse" style="background-color: #eaeaea;border: 1px solid #eaeaea;margin-bottom:0px;">
                                                            <div id="panel-zero" class="panel panel-default" style="display:inline;">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseZero">
                                                                            <i class="fa fa-lock"></i> 
                                                                            Data Persetujuan 
                                                                            <span id="badge_approval" class="badge badge-default">0</span> 
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapseZero" class="panel-collapse collapse">
                                                                    <div class="panel-body" style="padding:0px;">
                                                                        <table class="table" id="table_approval" style="background-color:white; ">
                                                                            <thead>
                                                                                <tr>
                                                                                    <td>Date</td>
                                                                                    <td>User</td>
                                                                                    <td>Status</td>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <!-- <tr>
                                                                                    <td>20-Juni-2023</td>
                                                                                    <td>Root Admin</td>
                                                                                    <td><label class="label label-primary">Approved</label></td>
                                                                                </tr>                                                                                 -->
                                                                            </tbody>
                                                                        </table>
                                                                        <div class="col-md-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <div class="pull-right">                            
                                                                                    <button id="btn_approval_add" class="btn btn-primary btn-small" type="button">
                                                                                        <i class="fas fa-file-signature"></i>
                                                                                        Tambah Persetujuan
                                                                                    </button>                                                                                                                     
                                                                                </div>
                                                                            </div>
                                                                        </div>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                        <?php } ?>
                                                        <?php if($module_attachment == 1){ ?>
                                                        <div class="panel-group" id="accordion" data-toggle="collapse" style="background-color: #eaeaea;border: 1px solid #eaeaea;margin-bottom:0px;">
                                                            <div id="panel-one" class="panel panel-default" style="display:inline;">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                                            <i class="fa fa-paperclip"></i> 
                                                                            Data Attachment 
                                                                            <span id="badge_attachment" class="badge badge-default">0</span>  
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapseOne" class="panel-collapse collapse">
                                                                    <div class="panel-body" style="padding:0px;">
                                                                        <table class="table" id="table_attachment" style="background-color:white; ">
                                                                            <thead>    
                                                                                <tr>
                                                                                    <td>Name</td>
                                                                                    <td style="text-align:right;">Size</td>
                                                                                    <td>Date Created</td>
                                                                                    <td>Format</td>                                            
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <!-- <tr>
                                                                                    <td>20-Juni-2023</td>
                                                                                    <td><a class="btn_attachment_preview" href="#" style="cursor:pointer;">Data_bulan_sep.pdf</a></td>
                                                                                    <td><label class="label label-primary"><a class="btn_attachment_preview" href="#" style="cursor:pointer;color:white;">pdf</a></label></td>                                                                                    
                                                                                </tr>                                                                                 -->
                                                                            </tbody>
                                                                        </table>
                                                                        <div class="col-md-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <div class="pull-right">                            
                                                                                    <button id="btn_link_add" class="btn btn-primary btn-small" type="button">
                                                                                        <i class="fas fa-link"></i>
                                                                                        Tambah Link Sharing
                                                                                    </button>    
                                                                                    <button id="btn_attachment_add" class="btn btn-primary btn-small" type="button">
                                                                                        <i class="fas fa-paperclip"></i>
                                                                                        Tambah Attachment
                                                                                    </button>                                                                                                                                                                                                         
                                                                                </div>
                                                                            </div>
                                                                        </div>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                              
                                                        <?php } ?>                                                                                    
                                                    </div>           
                                                    <?php } ?>        
                                                    <!-- End of Approval & Attachment -->                                                                                  
                                                </div>                                                     
                                                <div class="col-md-6 col-xs-12 col-sm-12 padding-remove-side prs-0">
                                                    <!--
                                                    <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side" style="margin-bottom:4px;">
                                                      <div class="form-group">
                                                        <label class="col-md-5">Subtotal</label>
                                                        <div class="col-md-7">
                                                          <input id="subtotal" name="subtotal" type="text" value="0" class="form-control" style="text-align:right;" readonly='true'/>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    -->

                                                    <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side prs-0">
                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side prs-0" style="margin-bottom:4px;">
                                                            <div class="form-group">
                                                                <label class="col-md-5 form-label prs-0">Total Nilai Stock (Rp)</label>
                                                                <div class="col-md-7 prs-0">
                                                                    <input id="total" name="total" type="text" value="0" class="form-control"
                                                                           style="text-align:right;" readonly='true' />
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                </div>                                        
                                            </div>
                                            <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">
                                                <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side"
                                                     style="margin-top: 10px;margin-bottom:10px;">
                                                    <div class="form-group">
                                                        <!--
                                                        <div class="pull-left">                            
                                                          <button id="btn-journal" class="btn btn-default btn-small" type="button">
                                                            <i class="fas fa-clipboard-check"></i>
                                                            Jurnal Entri
                                                          </button>                                                            
                                                        </div> -->
                                                        <div class="pull-right">
                                                            <button id="btn-cancel" class="btn btn-warning btn-small" type="reset"
                                                                    style="display: inline;">
                                                                <i class="fas fa-times"></i>
                                                                Batal
                                                            </button>
                                                            <button id="btn-save" class="btn btn-primary btn-small" type="button"
                                                                    style="display: inline;">
                                                                <i class="fas fa-save"></i>
                                                                Simpan
                                                            </button>
                                                            <!--
                                                            <button id="btn-edit" class="btn btn-default btn-small" type="button"
                                                              style="display: inline;">
                                                              <i class="fas fa-edit"></i>
                                                              Ubah
                                                            </button>
                                                            -->
                                                            <button id="btn-update" class="btn btn-default btn-small" type="button"
                                                                    style="display: none;" data-id="0">
                                                                <i class="fas fa-check-square"></i>
                                                                Perbarui
                                                            </button>                              
                                                            <button id="btn-print" class="btn btn-default btn-small" type="button" data-id="0" data-number="0"
                                                                    style="display: none;" data-id="0">
                                                                <i class="fas fa-print"></i>
                                                                Cetak
                                                            </button>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>                
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side prs-0">
                    <div class="grid simple">
                        <div class="grid-body">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="col-md-6 col-xs-12 col-sm-12" style="padding-left: 0;">
                                        <h5><b>Data <?php echo $title; ?></b></h5>
                                    </div>
                                    <div class="col-md-6 col-xs-12 col-sm-12 padding-remove-right">
                                        <div class="pull-right">
                                            <button id="btn-export" onClick="" class="btn btn-default btn-small" type="button"
                                                    style="display: none;">
                                                <i class="fas fa-file-excel"></i>
                                                Ekspor Excel
                                            </button>                      
                                            <button id="btn-new" onClick="" class="btn btn-success btn-small" type="button"
                                                    style="display: inline;">
                                                <i class="fas fa-plus"></i>
                                                Buat <?php echo $title; ?> Baru
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side prs-5" style="padding-top:8px;">
                                    <div class="col-lg-2 col-md-2 col-xs-6 col-sm-6 form-group padding-remove-right prs-0 prl-5">
                                        <label class="form-label">Periode Awal</label>
                                        <div class="col-md-12 col-sm-12 padding-remove-side prl-5">
                                            <div class="input-append success date col-md-12 col-lg-12 no-padding" style="width:100%;">
                                                <input name="start" id="start" type="text" class="form-control input-sm" readonly="true"
                                                       value="<?php echo $first_date; ?>">
                                                <span class="add-on date-add"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-6 col-sm-6 form-group padding-remove-right prs-0 prr-5">
                                        <label class="form-label">Periode Akhir</label>
                                        <div class="col-md-12 col-sm-12 padding-remove-side">
                                            <div class="input-append success date col-md-12 col-lg-12 no-padding" style="width:100%;">
                                                <input name="end" id="end" type="text" class="form-control input-sm" readonly="true"
                                                       value="<?php echo $end_date; ?>">
                                                <span class="add-on date-add"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12 form-group prs-0 prs-5">
                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">
                                            <label class="form-label">Gudang Asal</label>
                                            <select id="filter_gudang_from" name="filter_gudang_from" class="form-control">
                                                <option value="0">-- Semua --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12 form-group padding-remove-left prs-0 prs-5">
                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">
                                            <label class="form-label">Gudang Tujuan</label>
                                            <select id="filter_gudang_to" name="filter_gudang_to" class="form-control">
                                                <option value="0">-- Semua --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12 form-group padding-remove-right prs-0 prs-5">
                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">
                                            <label class="form-label">Karyawan Pelaksana</label>
                                            <select id="filter_kontak" name="filter_kontak" class="form-control">
                                                <option value="0">-- Semua --</option>
                                            </select>
                                        </div>
                                    </div>                                                                          
                                    <div class="col-lg-6 col-md-3 col-xs-6 col-sm-6 form-group padding-remove-right prs-0 prs-5">
                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">                                        
                                            <label class="form-label">Cari</label>
                                            <input id="filter_search" name="filter_search" type="text" value="" class="form-control" placeholder="Pencarian" />
                                        </div>
                                    </div>                                 
                                    <div class="col-lg-2 col-md-2 col-xs-6 col-sm-6 form-group prs-0 prs-5">
                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">                                        
                                            <label class="form-label">Tampil</label>
                                            <select id="filter_length" name="filter_length" class="form-control">
                                                <option value="10">10 Baris</option>
                                                <option value="25">25 Baris</option>
                                                <option value="50">50 Baris</option>
                                                <option value="100">100 Baris</option>
                                            </select>
                                        </div>    
                                    </div>                   
                                </div>  
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table id="table-data" class="table table-bordered" data-limit-start="0" data-limit-end="10" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Nomor</th>
                                                    <th>Karyawan</th>
                                                    <th>Total</th>                        
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab2">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-contact" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-master" name="form-master" method="" action="">         
                <div class="modal-header" style="background-color: #6F7A8A;">
                    <h4 style="color:white;">Buat Kontak Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 col-xs-12">
                            <p></p>
                            <p class="text-center">
                                <i class="fas fa-user-plus fa-5x"></i>
                            </p>
                        </div>
                        <div class="col-md-9 col-xs-12"> 
                            <div class="col-md-6 col-sm-12 col-xs-12">              
                                <div class="col-lg-5 col-md-5 col-xs-12 padding-remove-side">
                                    <div class="form-group">
                                        <label>Kode</label>
                                        <input id="kode_contact" name="kode_contact" type="text" value="" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input id="nama_contact" name="nama_contact" type="text" value="" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                    <div class="form-group">
                                        <label>Perusahaan</label>
                                        <input id="perusahaan_contact" name="perusahaan_contact" type="text" value="" class="form-control"/>
                                    </div>
                                </div>                      
                                <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input id="telepon_1_contact" name="telepon_1_contact" type="text" value="" class="form-control"/>
                                    </div>                          
                                </div>                                                           
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">

                                <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea id="alamat_contact" name="alamat_contact" type="text" value="" class="form-control"rows="8"/></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input id="email_1_contact" name="email_1_contact" type="text" value="" class="form-control"/>
                                    </div>                          
                                </div>                                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button id="btn-save-contact" onClick="" class="btn btn-primary btn-small" type="button" style="">
                        <i class="fas fa-save"></i>                                 
                        Simpan
                    </button>    
                    <button class="btn btn-outline-danger waves-effect btn-small" type="button" data-dismiss="modal">
                        <i class="fas fa-times"></i>                                 
                        Batal
                    </button>                   
                </div>
            </form>      
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-product" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-product" name="form-product" method="" action="">         
                <div class="modal-header" style="background-color: #6F7A8A;">
                    <h4 style="color:white;">Buat Produk Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 col-xs-12">
                            <p></p>
                            <p class="text-center">
                                <i class="fas fa-boxes fa-5x"></i>
                            </p>
                        </div>
                        <div class="col-md-9 col-xs-12"> 
                            <div class="col-md-12 col-sm-12 col-xs-12">              
                                <div class="col-lg-5 col-md-5 col-xs-12 padding-remove-side">
                                    <div class="form-group">
                                        <label>Kode Produk / SKU / PLU</label>
                                        <input id="kode_barang" name="kode_barang" type="text" value="" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input id="nama_barang" name="nama_barang" type="text" value="" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <select id="satuan_barang" name="satuan_barang" class="form-control">
                                            <option value="0">-- Pilih / Cari --</option>
                                        </select>
                                    </div>
                                </div>                                                                                 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button id="btn-save-product" onClick="" class="btn btn-primary btn-small" type="button" style="">
                        <i class="fas fa-save"></i>                                 
                        Simpan
                    </button>    
                    <button class="btn btn-outline-danger waves-effect btn-small" type="button" data-dismiss="modal">
                        <i class="fas fa-times"></i>                                 
                        Batal
                    </button>                   
                </div>
            </form>      
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>