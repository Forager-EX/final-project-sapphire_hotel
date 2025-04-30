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
    standard: { price: ₱ 2,500, description: "Standard Room with queen bed" },
    deluxe: { price: ₱ 4,000, description: "Deluxe Room with king bed" },
    Exclusive: {price: ₱6,000,description: "Exclusive Suite with separate living area"},
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
    ).innerHTML = `<strong>Room Type:</strong> ₱{
      roomType.charAt(0).toUpperCase() + roomType.slice(1)
    } - ${roomInfo.description}`;
    document.getElementById(
      "summaryGuests"
    ).innerHTML = `<strong>Number of Guests:</strong> ₱{numberOfGuests}`;
    document.getElementById(
      "summaryNights"
    ).innerHTML = `<strong>Total Nights:</strong> ₱{days}`;
    document.getElementById(
      "summaryTotalAmount"
    ).innerHTML = `<strong>Total Amount:</strong> ₱{totalCost.toFixed(2)}`;
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

  // Payment Overlay Elements
  const paymentOverlay = document.getElementById("paymentOverlay");
  const closeBtn = document.querySelector(".close-btn");
  const paymentForm = document.getElementById("paymentForm");

  // Form submission handler
  document
    .getElementById("bookingForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();

      // Get booking details
      const checkInDate = document.getElementById("checkInDate").value;
      const checkOutDate = document.getElementById("checkOutDate").value;
      const roomType = document.getElementById("roomType").value;
      const numberOfGuests = document.getElementById("numberOfGuests").value;

      // Validate all fields are filled
      if (!checkInDate || !checkOutDate || !roomType || !numberOfGuests) {
        alert("Please fill in all booking details");
        return;
      }

      // Calculate total amount
      const days = calculateDays(checkInDate, checkOutDate);
      const totalCost = roomTypes[roomType].price * days;

      // Show payment amount in overlay
      document.getElementById(
        "paymentAmount"
      ).innerHTML = `Total Amount: ₱{totalCost.toFixed(2)}`;

      // Show payment overlay
      paymentOverlay.style.display = "flex";
    });

  // Close overlay when X is clicked
  closeBtn.addEventListener("click", function () {
    paymentOverlay.style.display = "none";
  });

  // Close overlay when clicking outside the modal
  paymentOverlay.addEventListener("click", function (e) {
    if (e.target === paymentOverlay) {
      paymentOverlay.style.display = "none";
    }
  });

  // Payment form submission
  paymentForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Here you would normally process the payment
    // For demo purposes, we'll just show a success message

    // Hide payment overlay
    paymentOverlay.style.display = "none";

    // Update booking button to show success
    const confirmButton = document.getElementById("confirmButton");
    confirmButton.textContent = "Booking Confirmed!";
    confirmButton.disabled = true;
    confirmButton.classList.remove("btn-primary");
    confirmButton.classList.add("btn-success");

    // You might want to redirect or show a more detailed confirmation
    alert("Payment successful! Your booking has been confirmed.");
  });
});
