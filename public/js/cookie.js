var shown = sessionStorage['shown'];
if(!shown){
    $(window).on('load',function(){
        $('#cookieModal').modal('show');
        sessionStorage['shown'] = true;
    });
}
