$("#finishDate").change(function () {
    var startDate = document.getElementById("startDate").value;
    var finishDate = document.getElementById("finishDate").value;
 
    if ((Date.parse(finishDate) <= Date.parse(startDate))) {
        alert("End date should be greater than Start date");
        document.getElementById("finishDate").value = "";
    }
});

// function validateEndDate() {
//     var startDate = document.getElementById("startDate").value;
//     var finishDate = document.getElementById("finishDate").value;   

//     if (startDate=='' && finishDate==''){
//         $(startDate).datetimepicker({
//             useCurrent: false,
//             format: 'DD/MM/YYYY'
//         }).on('dp.change',validateEndDate(e){
//             $(".day").click(function()){
//                 $("a")
//             }
//         })
//     }
// }