<html>
<body>
<canvas class="js-canvas"></canvas>
</body>
<Script>

class Cannabis {
  constructor(element, options) {
    const canvas  = this.canvas  = element;
    const context = this.context = canvas.getContext('2d');
    const defaults = {
      a: 0.9,
      b: 0.1,
      c: 0.1,
      nodes: 1000,
      size: 100
    };

    this.options = Object.assign(this, defaults, options);

    this.setSize();
    this.update();
    this.addEventListeners();
  }

  render() {
    const { context } = this;
    const { a, b, c, nodes, size } = this.options;
    
    context.fillStyle = '#27ae60';

    context.beginPath();
    for (let i = 0; i < 2 * Math.PI; i+= 2 * Math.PI / nodes) {
      const radius = size *
                     (1 + Math.cos(8 * i) * a) *
                     (1 + Math.cos(24 * i) * b) *
                     (0.9 + Math.cos(200 * i) * c) *
                     (1 + Math.sin(i));
      const x = radius * Math.cos(i);
      const y = radius * -Math.sin(i);

      context.lineTo(x, y);
    }

    context.fill();
    context.closePath();
  }

  update() {
    const { context, width, height } = this;

    context.clearRect(width / -2, height / -1.25, width, height);
    this.render();

    requestAnimationFrame(() => this.update());
  }

  setSize() {
    const { canvas, context } = this;

    const width  = this.width  = canvas.width  = window.innerWidth;
    const height = this.height = canvas.height = window.innerHeight;

    context.translate(width / 2, height / 1.25);
  }

  onResize() {
    this.setSize();
  }

  addEventListeners() {
    window.addEventListener('resize', () => this.onResize());
  }
}
const cannabis = new Cannabis(document.querySelector('.js-canvas'));

</script>




</html>
