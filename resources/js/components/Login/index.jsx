import styles from "./styles.module.css";
import { NavLink } from "react-router-dom";
import { HandleSetFormType } from "../../manager";

import Img1 from "../../assets/Voluntario.png";
import Img2 from "../../assets/Cesta.png";

export default function Login() {
    return (
        <div className={styles.Container}>
            <div className={styles.box}>
                <img src={Img1} alt="" />
                <NavLink
                    to="/form"
                    style={{
                        width: "100%",
                        display: "flex",
                        justifyContent: "center",
                        textDecoration: "none",
                    }}
                >
                    <button
                        onClick={() => {
                            HandleSetFormType("login");
                        }}
                    >
                        Sou Assistente
                    </button>
                </NavLink>
            </div>

            <div className={styles.box}>
                <img src={Img2} alt="" />
                <NavLink
                    to="/form"
                    style={{
                        width: "100%",
                        display: "flex",
                        justifyContent: "center",
                        textDecoration: "none",
                    }}
                >
                    <button
                        onClick={() => {
                            HandleSetFormType("agendamento");
                        }}
                    >
                        Sou Beneficiario
                    </button>
                </NavLink>
            </div>
        </div>
    );
}
