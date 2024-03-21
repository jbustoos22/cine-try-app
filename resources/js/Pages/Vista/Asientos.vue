<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>
<template>
    <Head :title="'Asientos'" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-weight-semibold text-xl text-gray-800 dark:text-gray-200 my-4"
            >
                Inicio
            </h2>
        </template>
        <div class="card">
            <div class="card-body">
                <div class="seating-map">
                    <h2>Seleccione asiento en el mapa continuación</h2>
                    <div class="seats-grid cuadro">
                        <div
                            v-for="(row, rowIndex) in seatsMatrix"
                            :key="rowIndex"
                            class="seat-row"
                        >
                            <div
                                v-for="(seat, seatIndex) in row"
                                :key="`seat-${rowIndex}-${seatIndex}`"
                                class="seat"
                                :class="{
                                    selected: selectedSeats.includes(seat),
                                }"
                                @click="toggleSeat(seat)"
                            >
                                {{ seat }}
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-dark" @click="checkout">
                        Terminar Compra
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    data() {
        return {
            totalSeats: 60,
            selectedSeats: [],
            seatsMatrix: [],
        };
    },
    mounted() {
        this.generateSeatsMatrix();
    },
    methods: {
        toggleSeat(seatNumber) {
            if (this.selectedSeats.includes(seatNumber)) {
                this.selectedSeats = this.selectedSeats.filter(
                    (seat) => seat !== seatNumber
                );
            } else {
                this.selectedSeats.push(seatNumber);
            }
        },
        checkout() {
            window.location.replace('http://127.0.0.1:8000/mail');
        },
        generateSeatsMatrix() {
            let matrix = [];
            for (let i = 0; i < 10; i++) {
                let row = [];
                for (let j = 0; j < 6; j++) {
                    row.push(`F${i + 1} - S${j + 1}`);
                }
                matrix.push(row);
            }
            this.seatsMatrix = matrix;
        },
    },
};
</script>

<style>
.seating-map {
    text-align: center;
}

.seats-grid {
    display: flex;
    flex-direction: column;
    gap: 5px;
    align-items: center;
    max-width: 500px;
}

.seat-row {
    display: flex;
    justify-content: center;
    gap: 5px;
}



.seat {
    width: 50px;
    height: 50px;
    background-color: #7b8a8b; /* Color del asiento */
    border: 2px solid #464e50; /* Borde del asiento */
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    position: relative;
    font-size: 10px;
    border-radius: 10px; /* Bordes redondeados para hacerlo más similar a una silla de cine */
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.3); /* Sombra para dar profundidad */
    transform-style: preserve-3d; /* Para conservar la perspectiva 3D de transformaciones descendentes */
}

.seat.selected {
    background-color: #004990; /* Color del asiento seleccionado */
    color: white;
}

/* Asiento seleccionado */
.seat.selected::before {
    content: "";
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: #004990; /* Color del asiento seleccionado */
    border-radius: 10px;
}

.seat::after {
    content: "";
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 12px solid transparent;
    border-right: 12px solid transparent;
    border-bottom: 12px solid #464e50; /* Triángulo para simular el respaldo del asiento */
}

.cuadro {
    background-color: white;
    padding: 25px;
    perspective: 1000px; /* Agregamos perspectiva para el efecto 3D */
    margin: 0 auto; /* Centrar el contenedor horizontalmente */
    max-width: fit-content; /* Ajustar el ancho del contenedor al contenido interno */
}
</style>
