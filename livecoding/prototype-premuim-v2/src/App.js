import logo from './logo.svg';
import './App.css';
import React from 'react';
import Table from './Pages/Table';
import ChartBar from './Pages/chart';
class App extends React.Component {

  render(){
  return (
    <div className="App">
      App
      <Table />
      <ChartBar/>
    </div>
  );
}
}

export default App;
