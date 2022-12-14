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
  const [NumberApprenant, setNumberApprenant] = useState([]);
  const cookies = new Cookies();

  useEffect(() => {
    
    
    let idFormateur = cookies.get("FormateurID");

  // détail de groupe
    const OneGroupe = async () => {
      await axios
        .get("http://localhost:8000/api/OneGroupe/" + idFormateur)
        .then((res) => {
          setOneGroupe(res.data[0]);
          setNumberApprenant(res.data[1]);
        });
    };
    OneGroupe();
  
  }, []);


  return (
    <div>
      <div className="container">
        <div className="row">
          <div className="col-sm-9">
            <h1>Tableau de borde d’état d’avancement</h1>
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
           <AvancementGroupe/>

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
