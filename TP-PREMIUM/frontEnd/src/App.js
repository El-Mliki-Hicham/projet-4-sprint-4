  import logo from './logo.svg';
  import './App.css';
  import Table from './components/Table';
  import Chart from './components/chart';
  import React from 'react';
  import axios from 'axios';



class App extends React.Component {
state={
  DataTasks:[]
}

  componentDidMount(){
        
    axios.get("http://127.0.0.1:8000/api/task")
    .then(res=>{
        this.setState({
       DataTasks:res.data
    })
})

}

  
  render(){
// console.log()

  return (
    <div>
    <div className="">
      <Table />
    </div>
   <div className="App">
    <Chart DataTasks={this.state.DataTasks} />
   </div >

    </div>
  );
}
}
export default App;
