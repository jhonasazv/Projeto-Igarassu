import styles from "./styles.module.css";
import { Link } from "@inertiajs/inertia-react"; // 
import { HandleSetFormType } from "../../manager";

import Img from "../../assets/logo igarassu.svg";
import Img2 from "../../assets/BAckArrow.svg";

export default function Header({ type }) {
    return (
        <div className={styles.Container}>
            <img
                src={Img}
                onClick={() => {
                    window.location.href = "/"; // Simples redirecionamento para a raiz
                }}
                alt=""
            />
            {!type ? (
                <Link href="/form" style={{ textDecoration: "none" }} onClick={() => HandleSetFormType("agendamento")}>
                    <button>
                        <h6>Agendar uma visita</h6>
                    </button>
                </Link>
            ) : (
                <button
                    onClick={() => {
                        window.history.back(); //
                    }}
                >
                    <img src={Img2} alt="" />
                    <h6>Voltar</h6>
                </button>
            )}
        </div>
    );
}