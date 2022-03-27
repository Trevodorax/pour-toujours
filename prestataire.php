<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/prestataire.css">
    </head>
    <body>

        <?php include('includes/header.php'); ?>

        <main>
            <h2>Bonjour Evelynn ! <a href="#"><img src="images/settings_icon.svg"></a><a href="#"><img src="images/presta_contact_icon.svg"></a></h2>
            <section id="profile">
                <div>
                    <h3>Vos informations :</h3>
                    <h4>Nom complet : Evelynn Delon</h4>
                    <p>Métier : photographe</p>
                    <p>Nom de votre entreprise : Clair'Esprit</p>
                    <p>Email : evelynn.pro@gmail.com</p>
                    <p>Tel pro : 0154987850</p>
                    <p>Secteur : Orléans</p>
                </div>
                <img src="images/prestataires/prestataire1.jpg">
            </section>
            <section id="services">
                <h3>Vos services</h3>
                <div>
                    <div class="service-card">
                        <h4>Photos mariage</h4>
                        <p>Tarif : 20€/h</p>
                        <p>Description : Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="service-card">
                        <h4>Photos mariage</h4>
                        <p>Tarif : 20€/h</p>
                        <p>Description : Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="service-card">
                        <h4>Photos mariage</h4>
                        <p>Tarif : 20€/h</p>
                        <p>Description : Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="service-card">
                        <h4>Photos mariage</h4>
                        <p>Tarif : 20€/h</p>
                        <p>Description : Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                
            </section>
            <section id="clients">
                <h3>Vos clients</h3>
                <table>
                    <tr>
                        <th>Nom complet</th>
                        <th>Date du mariage</th>
                        <th>Service</th>
                        <th>Adresse email</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>Fredo Sananos</td>
                        <td>2/09/22</td>
                        <td>2</td>
                        <td>f.sananes@gmail.com</td>
                        <td><img src="images/presta_contact_icon.svg"></td>
                    </tr>
                    <tr>
                        <td>Fredo Sananos</td>
                        <td>2/09/22</td>
                        <td>2</td>
                        <td>f.sananes@gmail.com</td>
                        <td><img src="images/presta_contact_icon.svg"></td>
                    </tr>
                    <tr>
                        <td>Fredo Sananos</td>
                        <td>2/09/22</td>
                        <td>2</td>
                        <td>f.sananes@gmail.com</td>
                        <td><img src="images/presta_contact_icon.svg"></td>
                    </tr>
                    <tr>
                        <td>Fredo Sananos</td>
                        <td>2/09/22</td>
                        <td>2</td>
                        <td>f.sananes@gmail.com</td>
                        <td><img src="images/presta_contact_icon.svg"></td>
                    </tr>
                </table>
            </section>
        </main>

        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/prestataire.js"></script>
    </body>
</html>
