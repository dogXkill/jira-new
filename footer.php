<!-- Javascripts -->
<script src="assets/plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
<script src="assets/js/main.min.js"></script>
<script>
let timerId = setInterval(function(){
    let request = new XMLHttpRequest();
    request.open('GET', 'php_files/online.php', true);
    request.send();
}
,60000);
</script>
