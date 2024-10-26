const dateElem = document.querySelector("input[name='date']");
let date = new Date();
date.setDate(date.getDate() + 1);
dateElem.min = date.toISOString().substring(0, "YYYY-MM-DD".length);
dateElem.valueAsDate = date;