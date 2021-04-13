  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
    <strong>Copyright &copy;  <?= date('Y') ?> <a href="http://adminlte.io">1718113 - Janico Desmile</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->




<!-- jQuery -->
<script src="<?= base_url(); ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/dist/js/adminlte.min.js"></script>
<!-- My Script -->
<script src="<?= base_url(); ?>/dist/js/myscript2.js"></script>
<!-- DataTables -->
<script src="<?= base_url(); ?>/plugins/datatables/jquery.dataTables.js"></script>

<script src="<?= base_url(); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url(); ?>/dist/js/pages/dashboard.js"></script>

<script src="<?= base_url(); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>/dist/js/demo.js"></script>
<script>
  $('.custom-file-input').on('change',function(){
    let filename = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(filename);
  });

  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "pageLength": 5,
    });
  });

  $(document).ready(function(){
        $('#kecamatan').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?= base_url();?>Admin/getKel",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '<option value='+ 0 +'>Pilih Kelurahan</option>';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id +'>'+data[i].nama_kel+'</option>';
                    }
                    $('.kelurahan').html(html);
                     
                }
            });
        });
    });

  $(document).ready(function(){
        $('#kelurahan').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?= base_url();?>Admin/getnama",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '<option value='+ 0 +'>Pilih Bengkel</option>';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id_bengkel +'>'+data[i].nama_bengkel+'</option>';
                    }
                    $('.nama_bengkel').html(html);
                     
                }
            });
        });
    });

   $("#image").change(function(event) {  
      fadeInAdd();
      getURL(this);    
    });

    $("#image").on('click',function(event){
      fadeInAdd();
    });

    function getURL(input) {    
      if (input.files && input.files[0]) {   
        var reader = new FileReader();
        var filename = $("#image").val();
        filename = filename.substring(filename.lastIndexOf('\\')+1);
        reader.onload = function(e) {
          debugger;      
          $('#imgView').attr('src', e.target.result);
          $('#imgView').hide();
          $('#imgView').fadeIn(500);      
          $('.custom-file-label').text(filename);             
        }
        reader.readAsDataURL(input.files[0]);    
      }
      $(".alert").removeClass("loadAnimate").hide();
    }

    function fadeInAdd(){
      fadeInAlert();  
    }
    function fadeInAlert(text){
      $(".alert").text(text).addClass("loadAnimate");  
    }

    CKEDITOR.replace('konten',{
      uiColor:  '#DAA520'
    });
        CKEDITOR.replace('konten1',{
      uiColor:  '#DAA520'
    });

    function setToForm(Latitute,Longitude)
    {
      $('input[name="latitude"]').val(Latitute);
      $('input[name="longitude"]').val(Longitude);
    }
    
</script>
</body>
</html>
