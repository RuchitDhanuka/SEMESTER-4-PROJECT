function sortProducts(selectElement) {
  var selectedOption = selectElement.value;

  // Redirect to the same page with sort parameter in URL
  if (selectedOption) {
    window.location.href = window.location.pathname + '?sort=' + selectedOption;
  } else {
    window.location.href = window.location.pathname;
  }
}
