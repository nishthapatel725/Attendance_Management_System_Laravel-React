// import React from "react";
// import ReactApexChart from "react-apexcharts";

// class PieChart extends React.Component {
//   constructor(props) {
//     super(props);

//     this.state = {
//       chartData: [],
//       chartOptions: {},
//     };
//   }

//   componentDidMount() {
//     this.setState({
//       chartData: this.props.chartData,
//       chartOptions: this.props.chartOptions,
//     });
//   }

//   render() {
//     return (
//       <ReactApexChart
//         options={this.state.chartOptions}
//         series={this.state.chartData}
//         type='pie'
//         width='100%'
//         height='55%'
//       />
//     );
//   }
// }

// export default PieChart;
import React from "react";
import ReactApexChart from "react-apexcharts";

class PieChart extends React.Component {
  render() {
    const { chartData, chartOptions } = this.props;

    // Ensure that chartData and chartOptions are properly formatted
    const series = chartData.map((item) => item.value); // Extract values from chartData
    const labels = chartData.map((item) => item.name);  // Extract labels from chartData
    const colors = chartData.map((item) => item.color); // Extract colors from chartData

    // Construct the options dynamically
    const options = {
      ...chartOptions,
      labels: labels,  // Add dynamic labels
      colors: colors,  // Add dynamic colors
      chart: {
        ...chartOptions.chart,
        type: 'pie',
        width: '100%',
        height: '100%',
        offsetX: 0,
        offsetY: 0,
      },
      plotOptions: {
        pie: {
          expandOnClick: false,  // Optional: Disable expanding when clicked
          donut: {
            size: '65%',  // Optional: Makes the pie chart look like a donut (can adjust size)
          }
        }
      },
    };

    return (
      <div style={{ position: "relative", width: "100%", height: "300px" }}>
        <ReactApexChart
          options={options}
          series={series}  // Only pass the values (series) to the chart
          type="pie"
          width="100%"
          height="100%"
        />
      </div>
    );
  }
}

export default PieChart;