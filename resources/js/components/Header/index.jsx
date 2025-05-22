import styles from "./styles.module.css";
import { NavLink } from "react-router-dom";
import { HandleSetFormType } from "../../manager"; // Os tipos de form estao aqui
import { useNavigate } from "react-router-dom";

import Img from "../../assets/logo igarassu.svg";
import Img2 from "../../assets/BAckArrow.svg";

export default function Header({ type }) {
    const navigate = useNavigate();
    return (
        <div className={styles.Container}>
            <img
                src={Img}
                onClick={() => {
                    navigate("/");
                }}
                alt=""
            />
            {!type ? (
                <NavLink to="/form" style={{ textDecoration: "none" }}>
                    <button
                        onClick={() => {
                            HandleSetFormType("agendamento");
                        }}
                    >
                        <h6>Agendar uma visita</h6>
                    </button>
                </NavLink>
            ) : (
                <button
                    onClick={() => {
                        navigate(-1);
                    }}
                >
                    <img src={Img2} alt="" />
                    <h6>Voltar</h6>
                </button>
            )}
        </div>
    );
}
