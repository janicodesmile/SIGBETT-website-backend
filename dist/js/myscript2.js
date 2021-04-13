$(function() {

    $('.see-jawab').on('click', function(){

         $('#exampleModalLabel').html('FAQ Data')
         const pertanyaan = $(this).data('pertanyaan');
          const jawaban = $(this).data('jawaban');
          $('.modal-body').html(`<div class="callout callout-info">
                <h5>Pertanyaan</h5>
               <textarea class="form-control" readonly> `+ pertanyaan +` </textarea>
              </div>
              <div class="callout callout-info">
                <h5>Jawaban</h5>
                <textarea class="form-control" readonly> `+ jawaban +` </textarea>
              </div>`)
    });

    $('.see-detail').on('click', function(){

        const judul = $(this).data('judul');

        $('#exampleModalLabel').html('Detail Data '+ judul)

        const id = $(this).data('id');
        const gambar = $(this).data('gambar');
        const lokasi = $(this).data('lokasi');
        const konten = $(this).data('konten');
        const tanggal = $(this).data('tanggal');
        const dibuat = $(this).data('dibuat');
        $('.modal-body').html(`<div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                    <a target="_blank" href="http://localhost:8080/Astrotravel/dist/img/wisata/`+gambar+`">
                        <img src="http://localhost:8080/Astrotravel/dist/img/wisata/`+gambar+`" class="img-fluid">
                    </a>
                        <div class="callout callout-info">
                            <h5>Dibuat</h5>
                            <input type="text" class="form-control" value="`+dibuat+`" readonly>
                        </div>
                        <div class="callout callout-info">
                            <h5>Tanggal</h5>
                            <input type="text" class="form-control" value="`+tanggal+`" readonly>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="callout callout-info">
                            <h5>Nama Wisata</h5>
                            <input type="text" class="form-control" value="`+judul+`" readonly>
                        </div>
                        <div class="callout callout-info">
                            <h5>Lokasi</h5>
                            <input type="text" class="form-control" value="`+lokasi+`" readonly>
                        </div>
                        <div class="callout callout-info">
                            <h5>Konten</h5>
                            <textarea class="form-control" name="konten" id="konten" rows="5" readonly>`+konten+`</textarea>
                        </div>
                    </div>
                </div>
            </div>
            `)

    });

});