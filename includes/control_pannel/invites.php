<main>
    <section>
        <h2>Vos invités :</h2>
        <table class="table table-stripped">
            <thead>
                <th><input type="text" id="nomComplet" placeholder="Nom complet"></th>
                <th><input type="email" id="email" placeholder="Email"></th>
                <th><button onclick="addGuest()" class="btn btn-primary">Ajouter un invité</button></th>
            </thead>
            <tbody id="guestsList">

            </tbody>
        </table>
    </section>

    <script src="scripts/invites.js"></script>
</main>
