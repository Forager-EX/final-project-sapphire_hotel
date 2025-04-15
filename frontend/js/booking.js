document.addEventListener("DOMContentLoaded", function () {
  // Initialize date pickers
  flatpickr("#checkInDate", {
    dateFormat: "Y-m-d",
    minDate: "today",
    onChange: function (selectedDates, dateStr) {
      if (dateStr) {
        checkoutCalendar.set("minDate", dateStr);
      }
      updateBookingSummary();
    },
  });

  const checkoutCalendar = flatpickr("#checkOutDate", {
    dateFormat: "Y-m-d",
    minDate: "today",
    onChange: function () {
      updateBookingSummary();
    },
  });

  // Room data
  const roomTypes = {
    standard: { price: 199, description: "Standard Room with queen bed" },
    deluxe: { price: 299, description: "Deluxe Room with king bed" },
    suite: {
      price: 399,
      description: "Executive Suite with separate living area",
    },
  };

  // Function to calculate total nights
  function calculateDays(start, end) {
    const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
    const startDate = new Date(start);
    const endDate = new Date(end);
    return Math.round(Math.abs((startDate - endDate) / oneDay));
  }

  // Function to update booking summary
  function updateBookingSummary() {
    const checkInDate = document.getElementById("checkInDate").value;
    const checkOutDate = document.getElementById("checkOutDate").value;
    const roomType = document.getElementById("roomType").value;
    const numberOfGuests = document.getElementById("numberOfGuests").value;

    if (!checkInDate || !checkOutDate || !roomType || !numberOfGuests) {
      // Clear summary if any field is missing
      document.getElementById("summaryRoomType").innerHTML = "";
      document.getElementById("summaryGuests").innerHTML = "";
      document.getElementById("summaryNights").innerHTML = "";
      document.getElementById("summaryTotalAmount").innerHTML = "";
      return;
    }

    const days = calculateDays(checkInDate, checkOutDate);
    const roomInfo = roomTypes[roomType];
    const totalCost = roomInfo.price * days;

    // Update summary fields
    document.getElementById(
      "summaryRoomType"
    ).innerHTML = `<strong>Room Type:</strong> ${
      roomType.charAt(0).toUpperCase() + roomType.slice(1)
    }`;
    document.getElementById(
      "summaryGuests"
    ).innerHTML = `<strong>Number of Guests:</strong> ${numberOfGuests}`;
    document.getElementById(
      "summaryNights"
    ).innerHTML = `<strong>Total Nights:</strong> ${days}`;
    document.getElementById(
      "summaryTotalAmount"
    ).innerHTML = `<strong>Total Amount:</strong> $${totalCost.toFixed(2)}`;
  }

  // Event listeners for input fields
  document
    .getElementById("checkInDate")
    .addEventListener("change", updateBookingSummary);
  document
    .getElementById("checkOutDate")
    .addEventListener("change", updateBookingSummary);
  document
    .getElementById("roomType")
    .addEventListener("change", updateBookingSummary);
  document
    .getElementById("numberOfGuests")
    .addEventListener("input", updateBookingSummary);

  // Form submission handler
  document
    .getElementById("bookingForm")
    .addEventListener("submit", function (e) {
      e.preventDefault(); // Prevent default form submission

      // Disable the button and show confirmation message
      document.getElementById("confirmButton").textContent =
        "Booking Confirmed!";
      document.getElementById("confirmButton").disabled = true;
    });
});
