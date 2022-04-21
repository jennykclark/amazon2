// Upload Items
async function upload(){
    let conn = await fetch("../apis/api-uploadCopy.php", {
      method : "POST",
      body : new FormData(document.querySelector("#upload_item"))
    })
    let response = await conn.json()
    console.log(response)
    if( conn.ok ){
       location.href = "../success/success.php"
     }else {
       alert(res['info'])
     }
  }

// validate email
async function send_email(){
    let conn = await fetch("../email/api-sign-up.php", {
      method : "POST",
    //   body : new FormData(document.querySelector("#form_sign_up"))
    })
    let response = await conn.json()
    console.log(response)
    if( conn.ok ){
        // alert("email has been sent")
        // location.href = "../success/success.php"
        location.href = "../sms/validate_sms.php"
    //   location.href = "../update_profile/success.php"
     }else {
       alert(res['info'])
     }
  }

//password email
async function password_email(){
    let conn = await fetch("../email/api-password.php", {
      method : "POST",
    })
    let response = await conn.json()
    console.log(response)
    if( conn.ok ){
        // alert("email has been sent");
        // location.href = "../success/success.php"
        location.href = "../success/success_sms_email.php"
     }else {
       alert(res['info'])
     }
  }

//log in
async function login(){
    const form = event.target.form
    console.log(form)
    let conn = await fetch("../apis/api-login.php", {
      method: "POST",
      body: new FormData(form)
    })
    let res = await conn.json()
    console.log(res)
    if(conn.ok ){
        location.href = "../home/home.php"
    }
  }

//sign up
async function sign_up(){
    let conn = await fetch("../apis/api-signup.php", {
      method : "POST",
      body : new FormData(document.querySelector("#sign_up"))
    })
    let response = await conn.json()
    console.log(response)
    if( conn.ok ){
      location.href = "../email/buttomEmail.php"
     }else {
       alert(res['info'])
     }
  }

// send sms
async function send_sms(){
  let conn = await fetch("../apis/api-validate-number.php", {
    method : "POST",
    body : new FormData(document.querySelector("#sms_up"))
  })
  let response = await conn.json()
  console.log(response)
  if( conn.ok ){
    // alert("sms was sent");
    // console.log("sms was sent");
    // console.log("pls work")
    // location.href = "../email/buttomEmail.php"
    location.href = "../success/success_sms_email.php"
   }else {
    alert(res['info'])
   }
}

// update items
async function updateItem(){
    let conn = await fetch("../apis/api-update-item.php", {
      method : "POST",
      body : new FormData(document.querySelector("#update_item"))
    })
    let response = await conn.json()
    console.log(response)
    if( conn.ok ){
       location.href = "../success/success.php"
     }else {
       alert(res['info'])
     }
  }

// transaction
async function update(){
    const form = event.target.form
    let conn = await fetch("../apis/transaction-update.php", {
      method: "POST",
      body: new FormData(document.querySelector("#update_profile"))
    })
    let res = await conn.json()
    console.log(res)
    if( conn.ok ){
       location.href = "../success/success.php"
    }else {
      alert(res['info'])
    }
  }

// update password
async function update_pass(){
    const form = event.target.form
    let conn = await fetch("../apis/api-update-password.php", {
      method: "POST",
      body: new FormData(document.querySelector("#update-password"))
    })
    let res = await conn.json()
    console.log(res)
    if( conn.ok ){
       location.href = "../success/success.php"
      console.log('worked')
    }else {
      alert(res['info'])
    }
  }

//update phone number
async function update_number(){
  let conn = await fetch("../apis/api-update-number.php", {
    method : "POST",
    body : new FormData(document.querySelector("#update-phone"))
  })
  let response = await conn.json()
  console.log(response)
  if( conn.ok ){
    // alert("sms was sent");
    // console.log("sms was sent");
    // console.log("pls work")
    // location.href = "../email/buttomEmail.php"
    location.href = "../success/success_sms_email.php"
   }else {
    alert(res['info'])
   }
}

//sign up form validate
function validateForm() {
  let x = document.forms["sign_up"]["last_name"].value;
  if (x == "") {
    alert("last name must be filled out");
    return false;
  }
  let y = document.forms["sign_up"]["name"].value;
  if (y == "") {
    alert("first name must be filled out");
    return false;
  }
  let q = document.forms["sign_up"]["email"].value;
  if (q == "") {
    alert("email must be filled out");
    return false;
  }
  var a = document.getElementById("phoneNumber").value;
  if (!a.length) {
    alert("Phone number must be filled out");
    return false;
  }else if (!a.match(/^[0-9]+$/)) {
    alert("Phone number must be filled with numbers only");
    return false;
  }else if (a.length == 8) {
    alert("Phone number must not be greater than 8 character length");
    return false;
  }
  var v = document.getElementById("passID").value;
  if (!v.length) {
    alert("Password must be filled out");
    return false;
  }else if (v.length > 20) {
    alert("Password must not be greater than 20 character length");
    return false;
  }else if (v.length < 5) {
  alert("Password must not be greater than 5 character length");
  return false;
}
}

//sign in form validate
function validate_signIN() {
  var a = document.getElementById("emailID").value;
  if (!a.length) {
    alert("Email must be filled out");
    return false;
  }else if (!a.match( /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
    alert("Email must be valid");
    return false;
  }
  var v = document.getElementById("passID").value;
  if (!v.length) {
    alert("Password must be filled out");
    return false;
  }else if (v.length > 20) {
    alert("Password must not be greater than 20 character length");
    return false;
  }else if (v.length < 5) {
  alert("Password must not be greater than 5 character length");
  return false;
}
}

//validate sms form
function validate_sms_form() {
  var a = document.getElementById("phoneNumber").value;
  if (!a.length) {
    alert("Phone number must be filled out");
    return false;
  }else if (!a.match(/^[0-9]+$/)) {
    alert("Phone number must be filled with numbers only");
    return false;
  }else if (a.length == 8) {
    alert("Phone number must not be greater than 8 character length");
    return false;
  }
}

//basic update item
function update_item_form() {
  var a = document.getElementById("item_name_id").value;
  if (!a.length) {
    alert("Item name must be filled out");
    return false;
  }else if (a.length > 255) {
    alert("Item name must not be greater than 255 character length");
    return false;
  }else if (a.length < 5) {
    alert("Item name must not be less than 5 character length");
    return false;
  }
  var m = document.getElementById("priceID").value;
  if (!m.length) {
    alert("Price must be filled out");
    return false;
  }else if (!m.match(/^[0-9]+$/)) {
    alert("Price must be filled with numbers only");
    return false;
  }else if (m.length > 10) {
    alert("Price must not be greater than 10 character length");
    return false;
  }
  // var p = document.getElementById("stockID").value;
  // if (!p.length) {
  //   alert("Stock ID must be filled out");
  //   return false;
  // }else if (!p.match(/^[0-9]+$/)) {
  //   alert("Stock ID must be filled with numbers only");
  //   return false;
  // }else if (p.length > 10) {
  //   alert("Stock ID must not be greater than 10 character length");
  //   return false;
  // }
  var qp = document.getElementById("descrID").value;
  if (!qp.length) {
    alert("description must be filled out");
    return false;
  // }else if (!qp.match(/^[0-9]+$/)) {
  //   alert("description must be filled with numbers only");
  //   return false;
  }else if (qp.length < 5) {
    alert("description must not be less than 5 character length");
    return false;
  }
}

//transaction form
function transaction_form() {
  var a = document.getElementById("nameID").value;
  if (!a.length) {
    alert("First Name must be filled out");
    return false;
  }else if (a.length > 20) {
    alert("First Name must not be greater than 20 character length");
    return false;
  }else if (a.length < 5) {
    alert("First Name must not be less than 5 character length");
    return false;
  }
  var m = document.getElementById("lastNameID").value;
  if (!m.length) {
    alert("Last Name must be filled out");
    return false;
  }else if (m.length > 20) {
    alert("Last Name must not be greater than 20 character length");
    return false;
  }else if (m.length < 5) {
    alert("Last Name must not be less than 5 character length");
    return false;
  }
  var b = document.getElementById("emailID").value;
  if (!b.length) {
    alert("Email must be filled out");
    return false;
  }else if (!b.match( /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
    alert("Email must be valid");
    return false;
  }
  var qp = document.getElementById("phoneID").value;
  if (!qp.length) {
    alert("Phone Number must be filled out");
    return false;
  }else if (!qp.match(/^[0-9]+$/)) {
    alert("Phone Number must be filled with numbers only");
    return false;
  }else if (qp.length == 8) {
    alert("Phone Number must not be less than 8 character length");
    return false;
  }
}

//update phone number form
function update_phone_form() {
  var w = document.getElementById("phoneID").value;
  if (!w.length) {
    alert("Phone Number must be filled out");
    return false;
  }else if (!w.match(/^[0-9]+$/)){
    alert("Phone Number must be filled with numbers only");
    return false;
  }else if (!w.length == 8){
    alert("Phone Number must be euqal to 8 characters");
    return false;
  }
  var b = document.getElementById("emailID").value;
  if (!b.length) {
    alert("Email must be filled out");
    return false;
  }else if (!b.match( /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
    alert("Email must be valid");
    return false;
  }
}

//update password form
function update_password_form() {
  var w = document.getElementById("passID").value;
  if (!w.length) {
    alert("Password must be filled out");
    return false;
  }else if (w.length > 20) {
    alert("Password must not be greater than 20 character length");
    return false;
  }else if (w.length < 5) {
  alert("Password must be greater than 5 character length");
  return false;
  }
  var b = document.getElementById("emailID").value;
  if (!b.length) {
    alert("Email must be filled out");
    return false;
  }else if (!b.match( /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
    alert("Email must be valid");
    return false;
  }
}

// //upload item
function upload_item_form() {
  var a = document.getElementById("item_name_id").value;
  if (!a.length) {
    alert("Item Name must be filled out");
    return false;
  }else if (a.length > 255) {
    alert("Item Name must not be greater than 255 character length");
    return false;
  }else if (a.length < 5) {
    alert("Item Name must not be less than 5 character length");
    return false;
  }
  var m = document.getElementById("priceID").value;
  if (!m.length) {
    alert("Price must be filled out");
    return false;
  }else if (!m.match(/^[0-9]+$/)) {
    alert("Price must be filled with numbers only");
    return false;
  }else if (m.length > 10) {
    alert("Price must not be greater than 10 character length");
    return false;
  }
  var p = document.getElementById("stockID").value;
  if (!p.length) {
    alert("Stock Amount must be filled out");
    return false;
  }else if (!p.match(/^[0-9]+$/)) {
    alert("Stock Amount must be filled with numbers only");
    return false;
  }else if (p.length > 10) {
    alert("Stock Amount must not be greater than 10 character length");
    return false;
  }
  var qp = document.getElementById("descrID").value;
  if (!qp.length) {
    alert("Description must be filled out");
    return false;
  }else if (qp.length < 5) {
    alert("Description must not be less than 5 character length");
    return false;
  }
}