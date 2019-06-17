<template>
    <div>
        <canvas id="canvas" v-on:mousedown="handleMouseDown" v-on:mouseup="handleMouseUp" v-on:mousemove="handleMouseMove" width="800px" height="800px"></canvas>
        <button @click="thicknessPlus()" >+</button>
        <button @click="thicknessMin()" >-</button>
        <button @click="changeColor('red')">red</button>
        <button @click="changeColor('blue')">blue</button>
        <button @click="changeColor('green')">green</button>
        <button @click="changeColor('black')">black</button>

        <p>{{style.thickness}}</p>
    </div>
</template>

<script>
    export default {

        methods: {

        }
    }
</script>
