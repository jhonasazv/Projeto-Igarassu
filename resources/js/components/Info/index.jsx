import styles from "./styles.module.css";
import { Link } from "@inertiajs/inertia-react"; // 
import { HandleSetFormType } from "../../manager";

import HeroImg from "../../assets/Hero.png";

export default function Info() {
    return (
        <div
            className={styles.Container}
            style={{ backgroundImage: `url(${HeroImg})` }}
        >
            <h1>Apoio para quem mais precisa!</h1>
            <h3>Solicite a visita de um Assistente Social na sua residência</h3>
            <Link href="/form" onClick={() => HandleSetFormType("agendamento")}>
                <button>
                    <h6>Solicitar Assistente</h6>
                </button>
            </Link>
        </div>
    );
}