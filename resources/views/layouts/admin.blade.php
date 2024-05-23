<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php $favicon = App\SiteSetting::where('name','favicon')->pluck('value')->first(); @endphp
    <title>{{ isset($title)?$title.' - ':'' }}{{isset($settingData['site_title']) && !empty($settingData['site_title'])  ? $settingData['site_title'] :'Ludo'}}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;1,300;1,400&family=Overpass:wght@200&family=Poppins:ital,wght@0,300;0,400;0,500;1,200;1,300;1,400&family=Source+Sans+3:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{url('/assets/favicon/'.$favicon)}}">
    
      <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
 <script src="{{ asset('/js/ckeditor/ckeditor.js') }}" type="text/javascript"></script>

 <script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" defer="defer"></script>
 
  <script src="{{ asset('/js/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
  <script type="text/javascript">
      $(document).ready(function () {
        CKEDITOR.replace( '#ckeditor' );
         $('#grdPrUpPrj').DataTable();
         $('.datatable').DataTable();
        

         $("body").on("click","img",function(){
            console.log($(this).attr("src"));
             $('#img_preview').attr('src',$(this).attr("src"));
             $('#img_preview_model').modal('show');
            });
         $("body").on("click",".im_preview",function(){
             $('#img_preview').attr('src',$(this).attr("src"));
             if($(this).attr("src") != undefined){
                 $('#img_preview_model').modal('show');
             }
            });
     });

      
    
  </script>
    
    @yield('styles')
    <style>
        tr{
            font-size:12px;
        }
      body{
      font-family: 'Open Sans', sans-serif;
       font-family: 'Overpass', sans-serif;
       font-family: 'Poppins', sans-serif;
       font-family: 'Source Sans 3', sans-serif;
      }
    </style>
</head>

<body style="height: auto;">

    <div class="wrapper">
        @include('partials.menu')
        <div class="main-panel">

            @include('partials.nav')
            
            <section class="content" style="padding-top: 20px">
                @if(session('message'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                @endif
                @if(session('msg'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-info" role="alert">{{ session('msg') }}</div>
                        </div>
                    </div>
                @endif
                @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              
                @yield('content')
            </section>
            <div class="modal fade" id="img_preview_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document" style="top: 30%;">
                    <div class="modal-content">
                    <div class="modal-header">
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <div class="screenshot_img">
                       <img src="" id="img_preview" style="width:100%">
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: green;color: white;font-size: 11px;">Close</button>
                    </div>
                    </div>
                </div>
                </div>
                
            
            <footer class="footer justify-content-center">
                <strong> </strong> All rights reserved  Copyright &copy; {{date('Y')}}
            </footer>
        </div>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('js/material-dashboard.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.datatable-User').dataTable({
            "aoColumnDefs": [
                { 
                    "bSortable": false, 
                    "aTargets": [ -1 ,-2,] // 
                    } 
                ],
                "order": [
                    [0, "desc"]
                ]
            });


            
            $('.fund-request').dataTable();

          

            $('#form-status').on('change', function(){
                $(this).closest('form').submit();
            });

            
              
        });
        
    </script>
    <script>
      $(function() {
        let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
        let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
        let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
        let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
        let printButtonTrans = '{{ trans('global.datatables.print') }}'
        let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'

        let languages = {
          'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
        };

        
      });

    </script>
    
    @yield('scripts')
    <script>
        ClassicEditor
        .create( document.querySelector( '#ckeditor' ) )
        .then( editor => {
        } )
        .catch( error => {
        } );

          $('#form-status').on('change', function(){
                $(this).closest('form').submit();
            });

            $(document).ready(function () {
    //   $('select').selectize({
    //       sortField: 'text'
    //   });
  });
    </script>
</body>

</html>
