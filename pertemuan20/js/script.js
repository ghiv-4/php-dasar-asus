// jquery tolong carikan saya document (apapun yang saya tuliskan dalam kurung)
$(document).ready(function(){

    // event ketika keyword ditulis
    $('#keyword').on('keyup', function(){
        $('#container').load('ajax/aktris.php?keyword=' + $('#keyword').val())
    }); // jquery carikan container, load(ubah) isinya dgn ajax/aktris.php -> keyword

});
