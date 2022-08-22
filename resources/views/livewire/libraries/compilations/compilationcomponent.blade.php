<div class="flex flex-column border border-black p-4">
    <style>
        .input-group{display: flex; flex-direction: column;}
        .input-group .data{display: flex; flex-direction: row;}
        .hint{margin-left: .5rem; font-style:  italic; font-size: .9rem; padding-top: .5rem;}
    </style>
     <form method="post" action="">
         <h1 class="font-bold mb-4 text-xl">Add Compilation to Library</h1>
         <div class="input-group">
             <label for="title">Title</label>
             <div class="data">
                 <input type="text" name="titles" id="title" value="" style="width: 24rem;"/>
                 <span class="hint">An A Cappella Christmas</span>
             </div>
         </div>
         <div class="input-group">
             <label for="title">SubTitle 1</label>
             <div class="data">
                 <input type="text" name="subtitles[]" id="subtitle1" value="" style="width: 24rem;"/>
                 <span class="hint">A Collection of Christmas Favorites</span>
             </div>
         </div>
         <div class="input-group">
             <label for="title">SubTitle 2</label>
             <div class="data">
                 <input type="text" name="subtitles[]" id="subtitle2" value="" style="width: 24rem;"/>
                 <span class="hint">Arranged by Kirby Shaw</span>
             </div>
         </div>
         <div class="input-group mt-4">
             <label for="title">Publisher</label>
             <div class="data">
                 <input type="text" name="publisher" id="Publisher" value="" style="width: 24rem;"/>
                 <span class="hint">Hal Leonard Corporation</span>
             </div>
         </div>
     </form>
</div>
