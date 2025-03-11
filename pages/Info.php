<style>
    .info-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        margin: 100px;
    }

    .card {
        width: 15em;
        height: 20em;
        padding: 1em;
        display: flex;
        font-size: 1.5em;
        overflow: hidden;
        border-radius: 1em;
        position: relative;
        text-decoration: none;
        align-items: flex-end;
        background-size: cover;
        color: var(--text-color);
        border: 3px solid #393838;
        background-position: center;
        background-color: var(--nav-color);
    }

    .info-heading {
        font-size: 4rem;
        text-align: center;
        margin-bottom: 5rem;
    }

      .info-btn {
        cursor: pointer;
        font-weight: 600;
        margin-top: 1em;
        font-size: 1.2rem;
        padding: 0.4rem 2rem;
        color: var(--text-color);
        background-color: transparent;
        border: 2px solid var(--text-color);
        border-radius: 4rem;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .info-btn:hover {
        background-color: var(--text-color);
        color: var(--nav-color);
    }

    .card h1 {
        margin: 0;
        font-size: 1.5em;
        line-height: 1.2em;
    }

    .card p {
        line-height: 2em;
        font-size: 0.7em;
        margin-top: 0.5em;
    }

    .card .date {
        top: 0;
        right: 0;
        opacity: 0.8;
        padding: 1em;
        line-height: 1em;
        font-size: 0.75em;
        position: absolute;
    }

    .card img {
        width: 100%;
        height: auto;
        margin: 0 auto;
        max-height: 6em;
        object-fit: cover;
    }

    .tags {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn {
        cursor: pointer;
        font-weight: 600;
        margin-top: 1em;
        font-size: 1.2rem;
        padding: 0.4rem 2rem;
        color: var(--text-color);
        background-color: transparent;
        border: 2px solid var(--text-color);
        border-radius: 4rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    @media screen and (max-width: 900px) {
        .info-heading {
            font-size: 2rem;
        }

        .card {
            max-width: calc(100vw - 4rem);
        }
    }

    @media screen and (max-width: 450px) {
        .info {
            display: block;
            text-align: center;
        }
    }
</style>

<input type="hidden" id="UserID" name="UserID" value="<?= $_SESSION['UserID']?>">
<input type="hidden" id="username" name="username" value="<?= $_SESSION['username']?>">
<input type="hidden" id="ProfilePic" name="ProfilePic" value="<?= isset($_SESSION['ProfilePic']) && $_SESSION['ProfilePic'] ? "uploads/images/" . $_SESSION['ProfilePic'] : "assets/imgs/User-Profile.png" ?>" alt="Profile Image">



<div class="info-container">
    <div class="card-grid-space">
        <div class="card">
            <div>
                <img src="assets/imgs/VetClinic.png" alt="">
                <h1>Veterinary Clinics</h1>
                <p>Veterinary Clinics provide care to keep pets healthy and happy.</p>
                <div class="date">============</div>
                <div class="tags">
                    <a href="info/VetClinics.php" class="btn">READ MORE</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-grid-space">
        <div class="card">
            <div>
                <img src="assets/imgs/RabiesPrev.png" alt="">
                <h1>Rabies Prevention</h1>
                <p>Rabies Prevention stops rabies through pet vaccination.</p>
                <div class="date">============</div>
                <div class="tags">
                    <a href="info/RabiesPrev.php" class="btn">READ MORE</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-grid-space">
        <div class="card">
            <div>
                <img src="assets/imgs/AntiRab.png" alt="">
                <h1>Anti-Rabies Act of 2007</h1>
                <p>The Anti-Rabies Act of 2007 ensures dog vaccination to stop rabies.</p>
                <div class="date">============</div>
                <div class="tags">
                    <a href="info/AntiRab.php" class="btn">READ MORE</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-grid-space">
        <div class="card">
            <div>
                <img src="assets/imgs/EmerCon.png" alt="">
                <h1>Emergency Contacts</h1>
                <p>Emergency Contacts ensure quick access to help when it matters.</p>
                <div class="date">============</div>
                <div class="tags">
                    <a href="info/EmerCon.php" class="btn">READ MORE</a>
                </div>
            </div>
        </div>
    </div>
</div>