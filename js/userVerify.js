function LoginUser() {
    $.ajax({
        type: "POST",//方法
        url: "http://127.0.0.1/myRentManageWeb/verify.php",//表單接收url
        data: $(`#form1`).serialize(),
        success: function (data) {
          window.alert(data[0].result);
          location.href = data[0].link;
        },
        error : function(data) {
          console.log("error");
        }
    });
}