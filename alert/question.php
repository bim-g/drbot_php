
<div id="deleteQ" class="w3-modal">
    <div class="w3-modal-content w3-card-4">
        <div class="w3-card-4">
        <header class="w3-container w3-blue-grey">          
            <h1>Prompt</h1>
        </header>
        <div class="w3-container">
            <p>DO You Want to Delete this {{src}}</p>
        </div>
        <footer class="w3-container w3-center w3-padding w3-blue-grey">
            <form action="../controller/{{target}}" methode="POST">
                <input type="hidden" name="iduser" value="{{id_elem}}">
                <input type="hidden" name="idelemnt" value="{{id_elem}}">
                <button type="submit" name="{{src}}" value="deleteItem" class="w3-btn w3-round w3-border" onclick="w3.hide('#deleteQ')">yes</button>
                <button type="reset" class="w3-btn w3-round w3-border" onclick="w3.hide('#deleteQ')">Cancel</button>
            </form>
        </footer>
        </div>
    </div>
</div>