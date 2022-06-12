
<script src="./assets/vendors/popperjs/popper.min.js" defer></script>
<script src="./assets/vendors/bootstrap/bootstrap.min.js" defer></script>
<script src="./assets/js/nifty.js" defer></script>
<script src="./assets/js/demo-purpose-only.js" defer></script>
<script src="./assets/vendors/tabulator/tabulator.min.js" defer></script>
<script src="./assets/pages/tabulator.js" defer></script>

</html>


<script>
var today = new Date();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    document.getElementById("currentTime").value = time;


var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
document.getElementById("currentDate").value = date;
</script>