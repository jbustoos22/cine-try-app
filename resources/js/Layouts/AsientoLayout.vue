<template>
    <div class="seating-map">
      <h2>Mapa de Asientos</h2>
      <div class="seats">
        <div
          v-for="seat in totalSeats"
          :key="seat"
          class="seat"
          :class="{ selected: selectedSeats.includes(seat) }"
          @click="toggleSeat(seat)"
        >
          {{ seat }}
        </div>
      </div>
      <button @click="checkout">Checkout</button>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        totalSeats: 30,
        selectedSeats: []
      };
    },
    methods: {
      toggleSeat(seat) {
        if (this.selectedSeats.includes(seat)) {
          this.selectedSeats = this.selectedSeats.filter(s => s !== seat);
        } else {
          this.selectedSeats.push(seat);
        }
      },
      checkout() {
        alert(`Has seleccionado los asientos: ${this.selectedSeats.join(", ")}`);
      }
    }
  };
  </script>
  
  <style>
  /* Estilos para los asientos */
  .seat {
    width: 40px;
    height: 40px;
    margin: 5px;
    border: 1px solid #c0c0c0;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
  }
  
  /* Estilos para asientos seleccionados */
  .seat.selected {
    background-color: #6ab04c;
    color: white;
  }
  </style>
  