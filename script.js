document.getElementById("button1").addEventListener("click", function() {
  localStorage.setItem("selectedButton", "Button 1");
  window.location.href = "view_customers.php";
});

document.getElementById("button2").addEventListener("click", function() {
  localStorage.setItem("selectedButton", "Button 2");
  window.location.href = "transfer_money.php";
});
