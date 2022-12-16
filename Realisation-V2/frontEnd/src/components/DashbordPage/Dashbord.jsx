import QuickChart from "quickchart-js";
import React from "react";
import Cookies from "universal-cookie";
import {
  useNavigate,
} from "react-router-dom";
import { useEffect, useState } from "react";
import axios from "axios";
import AvancementGroupe from "./AvancementGroupe";
import AvancementBriefs from "./AvancementBriefs";
import AvancementApprenant from "./AvancementApprenants";

function Dashbord() {
  const [OneGroupe, setOneGroupe] = useState([]);
  const [Anne_formation, setAnne_formation] = useState([]);
  const [NumberApprenant, setNumberApprenant] = useState([]);
  const [ChangeId, SetChangeId] = useState('');
  const cookies = new Cookies();

  useEffect(() => {
    
    
    let idFormateur = cookies.get("FormateurID");

  // détail de groupe
  
    const Groupe = async () => {
      await axios
        .get("http://localhost:8000/api/Groupe/" + idFormateur)
        .then((res) => {
          setOneGroupe(res.data.Groupe);
          setNumberApprenant(res.data.ToutalApprenants);
        });
    };
    Groupe();
    const anne_formation = async () => {
      await axios
        .get("http://localhost:8000/api/anne_formation/" + idFormateur)
        .then((res) => {
          // console.log(res.data)
          setAnne_formation(res.data);
          // setNumberApprenant(res.data.ToutalApprenants);
        });
    };
    anne_formation();
    
    

  }, []);
  
  
  const selectAnnee_scolaire=(e)=>{
    SetChangeId(e.target.value)
    const getGroupe = async () => {
      await axios
        .get("http://localhost:8000/api/getGroupe/" + e.target.value)
        .then((res) => {
          console.log(res.data)
          setOneGroupe(res.data.Groupe);
          setNumberApprenant(res.data.ToutalApprenant);
        });
        
    };
    getGroupe();
    
    
  }
  
  
  return (
    <div>
      <div className="container">
        <div className="row">
          <div className="col-sm-9">
            <h1>Tableau de borde d’état d’avancement</h1>
         <select onChange={selectAnnee_scolaire} name="" id="">
          {Anne_formation.map(value=>
          <option key={value.id} value={value.Annee_formation_id}>{value.Annee_scolaire} </option>
          )}
         </select>
          </div>
        </div>

        <div style={{ border: "23" }}>
          <br />
        </div>

        <div className="container groupee" id="group">
          <div className="row border border-primary">
            <div className="col-sm">image</div>
            <div className="col-sm">{OneGroupe.Nom_groupe}</div>
            <div className="col-sm">
              numbre des apprenants: {NumberApprenant}
            </div>
            <div className="col-sm">{OneGroupe.Annee_scolaire}</div>
          </div>
          <br />
          <div className="row">
            {/* etat du groupe */}
           <AvancementGroupe ChangeId={ChangeId} />

            {/* etat d'apprenant */}
           <AvancementApprenant  />

            {/* etat des briefs */}
          <AvancementBriefs/>
          {/* {ParamsId.id} */}

          </div>
        </div>
      </div>
    </div>
  );
}
export default Dashbord;
