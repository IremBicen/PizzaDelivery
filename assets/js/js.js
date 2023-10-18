function loginUser(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?l=1",
        data:{"name":document.getElementById("name").value,"password":document.getElementById("password").value},
        success:function(result){
            //console.log(result);
            if(result == 0){
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "User name and Password is correct.";
                document.getElementById("alert").classList.add("alertMessageSuccess");
                window.location = "dashboard.php?p=2";
            }else if(result == 1){
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "User name and Password is correct.";
                document.getElementById("alert").classList.add("alertMessageSuccess");
                window.location = "booking.php?p=3";
            }else{
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later";
                document.getElementById("alert").classList.add("alertMessageError");
            }
        }
    });
}
/*AddFunction*/
function addUser(){
        $.ajax({
            type:"POST",
            url:"func/ajaxControl.php?i=1",
            data:{"name":document.getElementById("nameC").value,"lastName":document.getElementById("last_nameC").value,"phone_number":document.getElementById("phone_numberC").value,"address":document.getElementById("addressC").value,"user_name":document.getElementById("user_nameC").value,"password":document.getElementById("passwordC").value},
            success:function(result){
                //console.log(result);
                if(result == "1"){
                    document.getElementById("alert").style.display = "block";
                    document.getElementById("alert").innerHTML = "Successful";
                    document.getElementById("alert").classList.add("alert-success");
                    window.location = "login.php";
                }else{
                    document.getElementById("alert").style.display = "block";
                    document.getElementById("alert").innerHTML = "There is a problem.Please try again later.";
                    document.getElementById("alert").classList.add("alert-warning");
                }
            }
        });
}
function addCompany(){
    var fd = new FormData(document.getElementById("companyA"));
    fd.append("label", "WEBUPLOAD");
    $.ajax({
        url: "func/ajaxControl.php?i=2",
        type: "POST",
        data: fd,
        processData: false,
        contentType: false
    }).done(function( data ) {
    });
    /*$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?i=2",
        data:{"company_name":document.getElementById("company_nameO").value,"address":document.getElementById("addressO").value,"phone_number":document.getElementById("phone_numberO").value,"user_name":document.getElementById("user_nameO").value,"password":document.getElementById("passwordO").value},
        success:function(result){
            //console.log(result);
            if(result == "1"){
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Successful";
                document.getElementById("alert").classList.add("alertMessageSuccess");
                window.location = "login.php";
            }else{
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem.Please try again later.";
                document.getElementById("alert").classList.add("alertMessageError");
            }
        }
    });*/
}

function addPizza(){
    var fd = new FormData(document.getElementById("pizzaA"));
    fd.append("label", "WEBUPLOAD");
    $.ajax({
        url: "func/ajaxControl.php?i=3",
        type: "POST",
        data: fd,
        processData: false,
        contentType: false
    }).done(function( data ) {
    });
    pizzaRead();
}
function pizzaOrder(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?i=4",
        data:{"food_id":document.getElementById("food_id").value,"pieces":document.getElementById("pieces").value,"specialRequest":document.getElementById("specialRequest").value,"specialRequest":document.getElementById("specialRequest").value},
        success:function(result){
            console.log(result);
            if(result == "1"){
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "We get your order";
                document.getElementById("alert").classList.add("alert-success");
            }else{
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem.Please try again later.";
                document.getElementById("alert").classList.add("alert-warning");
            }
            //document.getElementById("pizzaDetails").innerHTML = result;
        }
    });
}
/*Read */
function pizzaRead(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=7",
        data:{},
        success:function(result){
            //console.log(result);
            document.getElementById("pizzaRead").innerHTML = result;
        }
    });
}
function pizzaList(companyID){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=2",
        data:{"companyID":companyID},
        success:function(result){
            console.log(result);
            document.getElementById("pizzaList").innerHTML = result;
        }
    });
}
function pizzaDetails(foodID){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=3",
        data:{"food_id":foodID},
        success:function(result){
            //console.log(result);
            document.getElementById("pizzaDetails").innerHTML = result;
        }
    });
}

function orderRead(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=4",
        data:{},
        success:function(result){
            //console.log(result);
            document.getElementById("orderRead").innerHTML = result;
        }
    });
}
function orderHistoryRead(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=6",
        data:{},
        success:function(result){
            //console.log(result);
            document.getElementById("orderHistoryRead").innerHTML = result;
        }
    });
}

function companyList(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=8",
        data:{},
        success:function(result){
            //console.log(result);
            document.getElementById("companyList").innerHTML = result;
        }
    });
}

/*updateFill*/
function orderStatusFill(orderID){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=5",
        data:{"orderID":orderID},
        success:function(result){
            //console.log(result);
            document.getElementById("orderDetails").innerHTML = result;
        }
    });
}

/*update */
function updateOrderStatus(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?u=1",
        data:{"order_id":document.getElementById("order_id").value,"status":document.getElementById("status").value},
        success:function(result){
            console.log(result);
            if(result == "1"){
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "We get your order";
                document.getElementById("alert").classList.add("alert-success");
                orderRead();
            }else{
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem.Please try again later.";
                document.getElementById("alert").classList.add("alert-warning");                
            }
        }
    });
}

/* */
