document.addEventListener("DOMContentLoaded", function () {
  // Initialize date pickers
  const checkInInput = document.getElementById("checkInDate");
  const checkOutInput = document.getElementById("checkOutDate");

  const checkInCalendar = flatpickr(checkInInput, {
    dateFormat: "Y-m-d",
    minDate: "today",
    onChange: function (selectedDates) {
      if (selectedDates.length > 0) {
        checkOutCalendar.set("minDate", selectedDates[0]);
      }
      updateBookingSummary();
    },
  });

  const checkOutCalendar = flatpickr(checkOutInput, {
    dateFormat: "Y-m-d",
    minDate: "today",
    onChange: function () {
      updateBookingSummary();
    },
  });

  // Room data with prices
  const roomTypes = {
    standard: { price: 2500, description: "Standard Room with queen bed" },
    deluxe: { price: 4000, description: "Deluxe Room with king bed" },
    Exclusive: { price: 6000, description: "Exclusive Suite with separate living area" },
  };

  // Calculate number of days between dates
  function calculateDays(start, end) {
    const oneDay = 24 * 60 * 60 * 1000;
    const startDate = new Date(start);
    const endDate = new Date(end);
    return Math.round(Math.abs((startDate - endDate) / oneDay));
  }

  // Update booking summary dynamically
  function updateBookingSummary() {
    const checkInDate = document.getElementById("checkInDate").value;
    const checkOutDate = document.getElementById("checkOutDate").value;
    const roomType = document.getElementById("roomType").value;
    const guestInput = document.getElementById('numberOfGuests');
  const guestLimitNote = document.getElementById('guestLimitNote');

  roomTypeSelect.addEventListener('change', function () {
    let maxGuests = 1;
    let note = '';

    switch (this.value) {
      case 'standard':
        maxGuests = 1;
        note = 'Standard room allows only 1 guest.';
        break;
      case 'deluxe':
        maxGuests = 2;
        note = 'Deluxe room allows up to 2 guests.';
        break;
      case 'exclusive':
        maxGuests = 4;
        note = 'Exclusive Suite allows up to 4 guests.';
        break;
    }

    guestInput.value = '';
    guestInput.setAttribute('max', maxGuests);
    guestInput.setAttribute('min', 1);
    guestLimitNote.textContent = note;
  });

    if (!checkInDate || !checkOutDate || !roomType || !numberOfGuests) {
      document.getElementById("summaryRoomType").innerHTML = "";
      document.getElementById("summaryGuests").innerHTML = "";
      document.getElementById("summaryNights").innerHTML = "";
      document.getElementById("summaryTotalAmount").innerHTML = "";
      return;
    }

    const days = calculateDays(checkInDate, checkOutDate);
    const roomInfo = roomTypes[roomType];
    const totalCost = roomInfo.price * days;

    document.getElementById(
      "summaryRoomType"
    ).innerHTML = `<strong>Room Type:</strong> ${roomType.charAt(0).toUpperCase() + roomType.slice(1)} - ${roomInfo.description}`;
    document.getElementById(
      "summaryGuests"
    ).innerHTML = `<strong>Number of Guests:</strong> ${numberOfGuests}`;
    document.getElementById(
      "summaryNights"
    ).innerHTML = `<strong>Total Nights:</strong> ${days}`;
    document.getElementById(
      "summaryTotalAmount"
    ).innerHTML = `<strong>Total Amount:</strong> ₱${totalCost.toFixed(2)}`;
  }

  // Event listeners
  document.getElementById("checkInDate").addEventListener("change", updateBookingSummary);
  document.getElementById("checkOutDate").addEventListener("change", updateBookingSummary);
  document.getElementById("roomType").addEventListener("change", updateBookingSummary);
  document.getElementById("numberOfGuests").addEventListener("input", updateBookingSummary);

  // Payment Overlay Elements
  const paymentOverlay = document.getElementById("paymentOverlay");
  const closeBtn = document.querySelector(".close-btn");

  // Form submission handler
  document.getElementById("bookingForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const checkInDate = document.getElementById("checkInDate").value;
    const checkOutDate = document.getElementById("checkOutDate").value;
    const roomType = document.getElementById("roomType").value;
    const numberOfGuests = document.getElementById("numberOfGuests").value;

    if (!checkInDate || !checkOutDate || !roomType || !numberOfGuests) {
      alert("Please fill in all booking details");
      return;
    }

    const days = calculateDays(checkInDate, checkOutDate);
    const totalCost = roomTypes[roomType].price * days;

    document.getElementById("paymentAmount").innerHTML = `Total Amount: ₱${totalCost.toFixed(2)}`;
    paymentOverlay.classList.remove("d-none");
  });

  // Close overlay on X click
  closeBtn.addEventListener("click", function () {
    paymentOverlay.classList.add("d-none");
  });

  // Close overlay on outside click
  paymentOverlay.addEventListener("click", function (e) {
    if (e.target === paymentOverlay) {
      paymentOverlay.classList.add("d-none");
    }
  });

  // Payment success handling
  document.getElementById("paymentForm").addEventListener("submit", function (e) {
    e.preventDefault();
    paymentOverlay.classList.add("d-none");

    const confirmButton = document.getElementById("confirmButton");
    confirmButton.textContent = "Booking Confirmed!";
    confirmButton.disabled = true;
    confirmButton.classList.remove("btn-primary");
    confirmButton.classList.add("btn-success");

    alert("Payment successful! Your booking has been confirmed.");
  });
});

document.getElementById('bookingForm').addEventListener('submit', function(e) {
    // Add any client-side validation here
    if (!validateForm()) {
        e.preventDefault(); // Stop form submission if validation fails
    }
});

// Alternative AJAX approach
document.getElementById('confirmButton').addEventListener('click', function() {
    const formData = new FormData(document.getElementById('bookingForm'));
    
    fetch('', { // Empty string means submit to same URL
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.redirected) {
            window.location.href = response.url;
        }
    });
});