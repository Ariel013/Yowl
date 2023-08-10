
const color = d3.scaleOrdinal([ '#a6d854', '#ffd92f']);
const data = [ users, commentaires];
// console.log(data);
const radius = 125;
const g = d3.select('svg')
 .append('g')
 .attr('transform', `translate(${radius}, ${radius})`);

const arc = d3.arc()
  .innerRadius(0)
  .outerRadius(radius);

const arcs = d3.pie()(data);

g.selectAll('path')
  .data(arcs)
  .enter()
  .append('path')
  .attr('d', arc)
  .style('fill', (d, i) => color(i))
  .style('stroke', 'white')
  .style('stroke-width', 3);
