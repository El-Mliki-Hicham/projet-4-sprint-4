import QuickChart from "quickchart-js";
import React from "react";
import Cookies from "universal-cookie";
import {
  useRoutes,
  useRouteMatch,
  useHistory,
  useNavigate,
  generatePath,
  useParams,
} from "react-router-dom";
import { useEffect, useState } from "react";
import axios from "axios";
import AvancementGroupe from "./AvancementGroupe";
import AvancementBriefs from "./AvancementBriefs";
import AvancementApprenant from "./AvancementApprenants";

function Dashbord() {
  const [idParams, setIdParames] = useState([]);
  const [DataGroupes, setDataGroupes] = useState([]);
  const [ApprenantAV, setApprenantAV] = useState([]);
  const [Pourcentage, setPourcentage] = useState([]);
  const [chartImage, setChartImage] = useState();
  const [AllBriefs, setAllBriefs] = useState([]);
  const [OneGroupe, setOneGroupe] = useState([]);
  const [Apprenants, setApprenants] = useState([]);
  const [Apprenants2, setApprenants2] = useState("");
  const [NumberApprenant, setNumberApprenant] = useState([]);
  const [IdGroupe, setIdGroupe] = useState([]);
  const cookies = new Cookies();
  const navigate = useNavigate();
  // const router =  useHistory();
  // useEffect(() => {

  //         axios.get("http://localhost:8000/api/ListApprenant/" + IdGroupe)
  //         .then(res => {
  //             // console.log(res.data[0])

  //             setApprenants(res.data[0])

  //         })
  // }, [yourState]);

  const ParamsId = useParams();
  useEffect(() => {
    let idFormateur = cookies.get("FormateurID");

    //Api anné Scolaire
    const DataGroupes = async () => {
      await axios
        .get("http://localhost:8000/api/AllGroupes/" + idFormateur)
        .then((res) => {
          setDataGroupes(res.data);
          // console.log(res.data)
        });
    };
    DataGroupes();

    //Api Apprenants Groupe
    // const ApprenantsGroupe = async () => {
    //     await axios.get("http://localhost:8000/api/ListApprenant/" + idFormateur)
    //         .then(res => {
    //             // setDataGroupes(res.data)
    //             // console.log(res.data)
    //         })
    // }
    // ApprenantsGroupe()

    // Api One Groupe
    const OneGroupe = async () => {
      await axios
        .get("http://localhost:8000/api/OneGroupe/" + idFormateur)
        .then((res) => {
          setOneGroupe(res.data[0]);
          setNumberApprenant(res.data[1]);
        //   setApprenants(res.data[2]);
          setPourcentage(res.data[3].toFixed(0));
          setAllBriefs(res.data[4]);
          setApprenantAV(res.data[5]);
          // console.log(res.data)

          cookies.set("GroupeID", res.data[0].idGroupe);
        });
    };
    OneGroupe();
    setIdGroupe(cookies.get("GroupeID"));
  }, []);

  //selection avec anné scolaire
  function selectDate(e) {
    // setIdParames(ParamsId.id);
    const id = e.target.value;
    navigate(generatePath("/dashbord/:id", { id }));

    let idGroupe = e.target.value;
    // console.log(idGroupe)
    axios.get("http://localhost:8000/api/groupes/" + idGroupe).then((res) => {
      setOneGroupe(res.data[0][0]);
      setNumberApprenant(res.data[1]);
      setAllBriefs(res.data[2]);
      // console.log(res.data)
    });

    //Avancement groupe after select data
    axios
      .get("http://localhost:8000/api/AvancementGroups/" + idGroupe)
      .then((res) => {
        setPourcentage(res.data.toFixed(2));
      });
    axios
      .get("http://localhost:8000/api/ListApprenant/" +  ParamsId.id)
      .then((res) => {
        setApprenants(res.data.items);
      });
    //   console.log(e.target.value)
  }

  //select Brief
 

  //
 
  //
 
  return (
    <div>
      <div className="container">
        <div className="row">
          <div className="col-sm-9">
            <h1>Tableau de borde d’état d’avancement</h1>
          </div>
          <div className="col-sm">
            <select onChange={selectDate} name="" id="">
              {DataGroupes.map((value) => (
                <option key={value.id} value={value.id}>
                  {value.Annee_scolaire}
                </option>
              ))}
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
           <AvancementGroupe/>

            {/* etat d'apprenant */}
           <AvancementApprenant/>

            {/* etat des briefs */}
          <AvancementBriefs/>
          </div>
        </div>
      </div>
    </div>
  );
}
export default Dashbord;
