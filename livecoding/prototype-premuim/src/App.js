import logo from './logo.svg';
import './App.css';
import Table from './components/Table';
import Chart from './components/Chart';
import axios from 'axios';
import React from 'react';
class App extends React.Component {
  state ={
    data:[],
   
    
}
async componentDidMount(){
  await axios.get("http://127.0.0.1:8000/api/task")  
  .then(res=>
    // console.log(res.data)
    this.setState({
        data:res.data
    })
        )
}
  render(){
  
    console.log(this.state)
  return (
    <div className="App">
     hello
     <Table/>
     <Chart DataProps={this.state.data} />
    </div>
  );
}
}

export default App;
