$( document ).ready(function() {
    $(".img-fluid").bind("error",function(){
        $(this).attr("src","Materials/Front/Assets/images/notfoundimage.jpg");
    });
    /*let len = $(".img-fluid").length;
    for (let i = 0; i < len; i++) {
        $( ".img-fluid" ).eq(i).onerror(function () {
            $( ".img-fluid" ).eq(i).attr( "src", "Materials/Front/Assets/images/notfoundimage.jpg" );
        });
    }*/
});
function showImage(src, target) {
    var fr = new FileReader();
    // when image is loaded, set the src of the image where you want to display it
    fr.onload = function(e) { target.src = this.result; };
    src.addEventListener("change",function() {
        // fill fr with image data
        fr.readAsDataURL(src.files[0]);
    });
}
function selectFile(id){
    $('#' + id).trigger('click');
}
function search(action){
    let search = $("#search").val();
    if(search != ""){
        window.location.href = action + "/" + search;
    }
}
function filterMessages(link){
    let type = $("#message-type").val();
    if(type != ""){
        window.location.href = link + "?type=" + type;
    }
}
function selectLink(data, id){
    $("#" + id).val(data);
}
function imagesPreview(input, placeToInsertImagePreview){
    if (input.files) {
        var filesAmount = input.files.length;

        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();

            reader.onload = function(event) {
                let img = $.parseHTML('<img>');
                $(img).attr("class", "img-responsive");
                let image = $(img).attr('src', event.target.result);
                $(placeToInsertImagePreview).append("<div class='col-md-4'>"+ image[0].outerHTML +"</div>");
                //$(img).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
            }

            reader.readAsDataURL(input.files[i]);
        }
    }
}