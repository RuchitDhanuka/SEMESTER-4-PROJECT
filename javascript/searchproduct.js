function searchProducts() {
  var input, filter, cards, card, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  cards = document.getElementsByClassName("card");

  console.log("Filter:", filter); // Debugging

  for (i = 0; i < cards.length; i++) {
    card = cards[i];
    txtValue = card.textContent || card.innerText;
    console.log("Text value:", txtValue); // Debugging
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      card.style.display = "";
    } else {
      card.style.display = "none";
    }
  }
}