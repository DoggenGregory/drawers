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
    data: function () {
    return {
        drawObject :{
            coordinatesX : new Array(),
            coordinatesY : new Array(),
            color : new Array(),
            thickness : new Array(),
            stopLine: new Array(),
        },
      mouse: {
        current: {
          x: 0,
          y: 0
        },
        previous: {
          x: 0,
          y: 0
        },
        down: false,
        firstDown : false,

      },
        style:{
          thickness : 2,
            color : "#5af61f"
        }
    }
  },
  computed: {
    currentMouse: function () {
      var c = document.getElementById("canvas");
      var rect = c.getBoundingClientRect();

      return {
        x: this.mouse.current.x - (window.scrollX + rect.left),
        y: this.mouse.current.y - (window.scrollY + rect.top)

      }
    }
  },

  methods: {
    draw: function (event) {
      //requestAnimationFrame(this.draw);
     if (this.mouse.down ) {
       var c = document.getElementById("canvas");

         var ctx = c.getContext("2d");

        ctx.clearRect(0,0,800,800);


         this.drawObject.coordinatesX.push(this.currentMouse.x);
         this.drawObject.coordinatesY.push(this.currentMouse.y);
         this.drawObject.color.push(this.style.color);
         this.drawObject.thickness.push(this.style.thickness);
         if(this.mouse.firstDown == true){
             this.drawObject.stopLine.push("drawOff");
             this.mouse.firstDown = false;

         }else{
             this.drawObject.stopLine.push("drawOn");
         }
         //console.log(this.drawObject.coordinatesX.length);
         console.log(JSON.stringify(this.drawObject));


        //ctx.beginPath();
        // ctx.moveTo(this.currentMouse.x, this.currentMouse.y);
         for (var i = 0; i<this.drawObject.coordinatesX.length; i++){
             if(this.drawObject.stopLine[i]  == "drawOn") {
                 ctx.beginPath();
                 ctx.moveTo(this.drawObject.coordinatesX[i - 1], this.drawObject.coordinatesY[i - 1]);
                 ctx.lineTo(this.drawObject.coordinatesX[i], this.drawObject.coordinatesY[i]);
                 ctx.strokeStyle = this.drawObject.color[i];
                 ctx.lineWidth = this.drawObject.thickness[i];
                 ctx.stroke();
                 ctx.closePath();
             }
         }


     }

    },
      thicknessPlus: function() {
          this.style.thickness = this.style.thickness + 2;
      },
      thicknessMin: function() {
          this.style.thickness = this.style.thickness - 2;
      },
      changeColor: function(x) {
        if(x=='red'){
            this.style.color = "#f61914";

        }
          if(x=='blue'){
              this.style.color = "#326df6";
          }
          if(x=='green'){
              this.style.color = "#42f619";
          }
          if(x=='black'){
              this.style.color = "#000000";
          }


      },

      handleMouseDown: function (event) {
      this.mouse.down = true;
      this.mouse.firstDown = true;
      this.mouse.current = {
        x: event.pageX,
        y: event.pageY

      }
        var c = document.getElementById("canvas");
        var ctx = c.getContext("2d");

        ctx.moveTo(this.currentMouse.x, this.currentMouse.y)

    },
        handleMouseUp: function () {

      this.mouse.down = false;
    },
    handleMouseMove: function (event) {

      this.mouse.current = {
        x: event.pageX,
        y: event.pageY
      }

      this.draw(event)

    }
  },
    ready: function () {
        var c = document.getElementById("canvas");
        var ctx = c.getContext("2d");
        ctx.translate(0.5, 0.5);
        ctx.imageSmoothingEnabled= false;

    },


}
</script>
