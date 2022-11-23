import axios from "axios";
import React from "react";

class BriefTable extends React.Component{

    state={
        briefData :[] ,
    }

async componentDidMount(){
    await axios.get("http://127.0.0.1:8000/api/brief")
    .then((res)=>
     this.setState({
        briefData :res.data
     })
    )
}

    render(){
        console.log(this.state)
        return(
            <section>
            <div>
               search <input id="search"></input>
                
            </div>
            <div>
                <table className="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nom brief</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {this.state.briefData.map((brief)=>(
                        <tr key={brief.id}>
                            <td>{brief.id}</td>
                            <td>{brief.Nom_du_brief}</td>

                            <td><a className="btn btn-info" href={"/consulter/"+brief.id}>consulter</a></td>
                        </tr>
                        ))}
                    </tbody>
                </table>
            </div>
            </section>
        )
    }
}

export default BriefTable;