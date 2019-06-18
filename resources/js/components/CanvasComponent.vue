<template>
    <div>
        <canvas id="canvas" v-on:mousedown="handleMouseDown" v-on:mouseup="handleMouseUp" v-on:mousemove="handleMouseMove" width="800px" height="800px"></canvas>
        <button @click="thicknessPlus()" >+</button>
        <button @click="thicknessMin()" >-</button>
        <button @click="changeColor('rd')">red</button>
        <button @click="changeColor('bl')">blue</button>
        <button @click="changeColor('gn')">green</button>
        <button @click="changeColor('bk')">black</button>

        <p>{{style.thickness}}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            projectObject:[],
            drawObject :{
                coordinatesX : [],
                coordinatesY : [],
                color : [],
                thickness : [],
                stopLine: [],
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

  created() {
    this.fetchCanvas();

    Echo.join('chat')
        .listen('DrawingSent', (event) => {
            this.projectObject.push(this.fetchCanvas());
            this.drawCanvas();
        })
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
      fetchCanvas() {
        axios.get('canvas', {drawing:this.projectObject.length}).then(response => {
            this.projectObject = response.data;
            // console.log('tieten');
        })
    },
    draw: function (event) {
      //requestAnimationFrame(this.draw);
     if (this.mouse.down) {
       var c = document.getElementById("canvas");

         var ctx = c.getContext("2d");

        ctx.clearRect(0,0,800,800);


         this.drawObject.coordinatesX = this.currentMouse.x;
         this.drawObject.coordinatesY = this.currentMouse.y;
         this.drawObject.color = this.style.color;
         this.drawObject.thickness = this.style.thickness;
         if(this.mouse.firstDown == true){
             this.drawObject.stopLine="f";
             this.mouse.firstDown = false;
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
             //push naar mysql

             //axios van mysql


             //zet in array


       //////////////////////////////////////////////////////////////////////////////////////////////////////////////
         }else{
             this.drawObject.stopLine="n";
         }
         //console.log(this.drawObject.coordinatesX.length);
         //console.log(JSON.stringify(this.drawObject));
         //console.log(this.drawObject);
         console.log(this.currentMouse.x,this.currentMouse.y,this.style.color,this.style.thickness);
         axios.post('canvas', {drawObject: this.drawObject});




            //  axios.get('canvas').then(response => {
            //      this.projectObject = response.data;
            //     console.log(this.projectObject)
            //  })




     }

    },
    drawCanvas: function() {
        var c = document.getElementById("canvas");

         var ctx = c.getContext("2d");

        console.log(this.projectObject[0].break);

             for (var i = 0; i<this.projectObject.length; i++){
             if(this.projectObject[i].break  == "n") {
                 ctx.beginPath();
                 ctx.moveTo(this.projectObject[i - 1].corX, this.projectObject[i-1].corY);
                 ctx.lineTo(this.projectObject[i].corX, this.projectObject[i].corY);
                 ctx.strokeStyle = this.projectObject[i].color;
                 ctx.lineWidth = this.projectObject[i].thickness;
                 ctx.stroke();
                 ctx.closePath();
             }
         }
    },
      thicknessPlus: function() {
          this.style.thickness = this.style.thickness + 5;
      },
      thicknessMin: function() {
          this.style.thickness = this.style.thickness - 5;
      },
      changeColor: function(x) {
        if(x=='rd'){
            this.style.color = "#f61914";
        }
          if(x=='bl'){
              this.style.color = "#326df6";
          }
          if(x=='gn'){
              this.style.color = "#42f619";
          }
          if(x=='bk'){
              this.style.color = "#000000";
          }
      },

      handleMouseDown: function (event) {
      this.mouse.down = true;
      this.mouse.firstDown = true;
      this.mouse.current = {
        x: event.pageX,
        y: event.pageY
      };
        var c = document.getElementById("canvas");
        var ctx = c.getContext("2d");

        ctx.moveTo(this.currentMouse.x, this.currentMouse.y);

    },
      handleMouseUp: function () {

      this.mouse.down = false;
    },
    handleMouseMove: function (event) {

      this.mouse.current = {
        x: event.pageX,
        y: event.pageY
      }

      this.draw(event);
    },

  },
    ready: function () {
        var c = document.getElementById("canvas");
        var ctx = c.getContext("2d");
        ctx.translate(0.5, 0.5);
        ctx.imageSmoothingEnabled= false;
    },
}
</script>
<style>

    /**
    * Fix user-agent
    */

    * {
        box-sizing: border-box;
    }

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    /**
    * Canvas
    */

    .whiteboard {
        height: 100%;
        width: 100%;
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        top: 0;
    }

    .colors {
        position: fixed;
    }

    .color {
        display: inline-block;
        height: 48px;
        width: 48px;
    }

    .color.black { background-color: black; }
    .color.red { background-color: red; }
    .color.green { background-color: green; }
    .color.blue { background-color: blue; }
    .color.yellow { background-color: yellow; }
</style>
