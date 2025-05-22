import styles from "./styles.module.css";

// Import Images
import Img1 from "../../assets/Pomba.png";
import Img2 from "../../assets/CestaBasica.png";
import Img3 from "../../assets/Casa.png";
import Img4 from "../../assets/Pessoa.png";
import Img5 from "../../assets/Prancheta.png";
import Img6 from "../../assets/Monitor.png";

export default function Info() {
    return (
        <div className={styles.Container}>
            {/* -------------------- Section 1 -------------------------------  */}
            <h1>Benefícios Oferecidos</h1>
            <div className={styles.content}>
                {/* Box 1 */}
                <div className={styles.box}>
                    <img src={Img1} alt="" />
                    <h1>Auxilio funeral</h1>
                    <p>apoio para famílias enlutadas</p>
                </div>
                {/* Box 2 */}
                <div className={styles.box}>
                    <img src={Img2} alt="" />
                    <h1>Cestas básicas</h1>
                    <p>segurança alimentar para quem mais precisa</p>
                </div>
                {/* Box 3 */}
                <div className={styles.box}>
                    <img src={Img3} alt="" />
                    <h1>Outros benefícios</h1>
                    <p>serviços diversificados</p>
                </div>
            </div>
            {/* --------------------- Section 2 -------------------------------- */}
            <h1>Como Solicitar?</h1>
            <div className={styles.content}>
                {/* Box 1 */}
                <div className={styles.box}>
                    <img src={Img4} alt="" />
                    <h1>Cadastre-se</h1>
                    <p>no portal</p>
                </div>
                {/* Box 2 */}
                <div className={styles.box}>
                    <img src={Img5} alt="" />
                    <h1>Escolha o benefício</h1>
                    <p>e envie os documentos</p>
                </div>
                {/* Box 3 */}
                <div className={styles.box}>
                    <img src={Img6} alt="" />
                    <h1>Acompanhe sua</h1>
                    <p>solicitação pelo site</p>
                </div>
            </div>
        </div>
    );
}
