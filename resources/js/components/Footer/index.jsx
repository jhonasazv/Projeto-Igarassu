import styles from "./styles.module.css";

import Img1 from "../../assets/Telefone.svg";
import Img2 from "../../assets/Email.svg";
import Img3 from "../../assets/Instagram.svg";
import Img4 from "../../assets/Facebook.svg";
import Img5 from "../../assets/Youtube.svg";

export default function Footer() {
    return (
        <div className={styles.Container}>
            <div className={styles.titles}>
                <h1>Assistencia Social</h1>
                <h1>Siga-nos</h1>
            </div>
            <div className={styles.contact}>
                <div className={styles.item}>
                    <img src={Img1} alt="" />
                    <p>emailfalso@igarassu.com</p>
                </div>
                <div className={styles.item}>
                    <img src={Img2} alt="" />
                    <p>(81)97070-7070</p>
                </div>
                <div className={styles.itens}>
                    <button className={styles.socialBtn}>
                        <img src={Img4} alt="" />
                    </button>
                    <button className={styles.socialBtn}>
                        <img src={Img3} alt="" />
                    </button>
                    <button className={styles.socialBtn}>
                        <img src={Img5} alt="" />
                    </button>
                </div>
            </div>
        </div>
    );
}
