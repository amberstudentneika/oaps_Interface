<div>
    {{-- Success is as dangerous as failure. --}}
   @if($searchMode==false)
   <main class="mx-10 mt-5">

   <div class="mt-10 sm:mt-0">
     <div class="md:grid md:grid-cols-3 md:gap-6">
       <div class="md:col-span-1">
         <div class="px-4 sm:px-0">
           <h3 class="text-lg font-medium leading-6 text-gray-900">Find your Child</h3>
           <p class="mt-1 text-sm text-gray-600">
             Enter the child's identification number to start.
           </p>
         </div>
       </div>
       <div class="mt-5 md:mt-0 md:col-span-2">
         <form action="" wire:submit.prevent="onSubmit">
             <div class="shadow overflow-hidden sm:rounded-md">
             <div class="px-4 py-5 bg-white sm:p-6">
               <div class="grid grid-cols-6 gap-6">
            
                 <div class="col-span-6 sm:col-span-3">
                     <label class="block text-sm font-medium text-gray-700">Child's Identification Number</label>
                     <input  type="text" wire:model="childIDN" class="@error('childIDN')  border-red-500 @enderror mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                     @error('childIDN')
                     <p class="text-red-500 text-xs italic mt-4">
                         {{ "*required" }}
                     </p>
                     @enderror  
                 </div>
   
                
                
               </div>
             </div>
 
             <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
               <button type="submit" wire:click.prevent="onSubmit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                search
               </button>
             </div>
           </div>
         </form>
         
   @if (session()->has('message'))
   <div class="bg-red-100 mt-2 rounded-md px-4 py-3">  
       <strong class="font-bold text-red-500">Whoops!</strong>
       <p class="text-red-500">{{session()->get('message')}}</p>
       <p class="text-red-500">Please check and try again.</p>
   </div>
    @endif
       </div>
     </div>
   </div>
   </main>
@elseif($viewResult==true)
   <div class="flex  bg-gray-200 items-center justify-center   mb-32">
    
    <div class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
{{-- <button type="button" wire:click.prevent="show()" class='mt-4 w-auto hover:bg-blue-800 bg-blue-900 rounded-md shadow-xl font-medium text-white px-4 py-2 border-gray-400 focus:outline-none  focus:border-gray-500'>View student listing</button> --}}
<div class="flex justify-center py-4">
        <div class="flex bg-purple-200 rounded-full md:p-4 p-2 border-2 border-purple-300">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
      </div>
  
      <div class="flex justify-center">
        <div class="flex">
          <h1 class="text-gray-600 font-bold md:text-2xl text-xl">E-Voucher Registration Form</h1>
        </div>
      </div>
  
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
          <div class="grid grid-cols-1">
              <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Identification Number</label>
            <p class="text-gray-400 py-2 px-3 rounded-lg border-2 border-gray-200 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">{{$studentIDN}}</p>
          </div>
          <div class="grid grid-cols-1">
          </div>
        
    </div>
  
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
        <div class="grid grid-cols-1">
          <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Firstname</label>
        <p class="text-gray-400 py-2 px-3 rounded-lg border-2 border-gray-200 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
          {{$fname." ".$lname}}
        </p>
        </div>
        <div class="grid grid-cols-1">
          <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Gender</label>
          <p class="text-gray-400 py-2 px-3 rounded-lg border-2 border-gray-200 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
            {{$gender}}
          </p>
          {{-- <input readonly wire:model="lname" class="@error('lname')  border-red-500 @enderror py-2 px-3 rounded-lg border-2 border-gray-200 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent text-gray-400"  type="text" placeholder="Enter student's lastname" /> --}}
        </div>
      </div>
     <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
       <div class="grid grid-cols-1"> 
           <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Grade</label>
            <p class="text-gray-400 py-2 px-3 rounded-lg border-2 border-gray-200 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" >
              {{$grade}}
            </p>
          </div>
        <div class="grid grid-cols-1"> 
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Class</label>
            <p class="text-gray-400 py-2 px-3 rounded-lg border-2 border-gray-200 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" >
            {{$class}}
            </p>
          </div>
      </div>
  @if($formCondition == 0)
   <form wire:submit.prevent="addChild">
     <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
       <div class="grid grid-cols-1"> 
           <label class="uppercase md:text-sm text-xs text-blue-700 text-light font-semibold">Relation*</label>
        <select type="text" wire:model="relation" class="@error('relation')  border-red-500 @enderror cursor-pointer text-gray-400 py-2 px-3 rounded-lg border-2 border-gray-200 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
          <option value="">Select relationship to child</option>
        <option value="1">Mother</option>
        <option value="2">Father</option>
        <option value="3">Guardian</option>
        </select>
        @error('relation')
        <p class="text-red-500 text-xs italic mt-4">
            {{ "*required" }}
        </p>
        @enderror 
      </div>
        <div class="grid grid-cols-1"> 
         </div>
      </div>
  
      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-blue-700 text-light font-semibold mb-1">Upload Child's Birth Certificate*</label>
          <div class='flex items-center justify-center w-full'>
              <label class=' flex flex-col border-4 border-dashed w-full h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-200 group'>
                  <div class='flex flex-col items-center justify-center pt-7'>
                      <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                   @if($birthCert== '') 
                   <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>upload either JPG, JPEG, PDF file</p>
                   @else
                   <p class='lowercase text-sm text-purple-600 pt-1 tracking-wider'>{{$birthCert->getClientOriginalName()}}</p>
                  @endif
                  </div>
                  <input wire:model="birthCert" type='file' class="hidden" />
                </label>  
           
          </div>
          @error('birthCert')
          <p class="text-red-500 text-xs italic mt-4">
              {{ "*required" }}
          </p>
          @enderror 
          {{-- {{$bCert}} --}}
      </div>
        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
          <button type="button" wire:click.prevent='show()' class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancel</button>
          <button type="submit" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Add child</button>
        </div>
      </form>
      @else
      <form wire:submit.prevent="addChild">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
          <div class="grid grid-cols-1"> 
              <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Relation*</label>
           <select disabled type="text" wire:model="relation" class="@error('relation')  border-red-500 @enderror cursor-pointer text-gray-400 py-2 px-3 rounded-lg border-2 border-gray-200 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
             <option value="">Select relationship to child</option>
           <option value="1">Mother</option>
           <option value="2">Father</option>
           <option value="3">Guardian</option>
           </select>
           @error('relation')
           <p class="text-red-500 text-xs italic mt-4">
               {{ "*required" }}
           </p>
           @enderror 
         </div>
           <div class="grid grid-cols-1"> 
            </div>
         </div>
     
         <div class="grid grid-cols-1 mt-5 mx-7">
           <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Upload Child's Birth Certificate*</label>
             <div class='flex items-center justify-center w-full'>
                 <label class=' flex flex-col border-4 border-dashed w-full h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-200 group'>
                     <div class='flex flex-col items-center justify-center pt-7'>
                         <svg aria-disabled="" class="w-10 h-10 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                      @if($birthCert== '') 
                      <p class='lowercase text-sm text-gray-400 group-hover:text-gray-600 pt-1 tracking-wider'>upload either JPG, JPEG, PDF file</p>
                      @else
                      <p class='lowercase text-sm text-gray-600 pt-1 tracking-wider'>{{$birthCert->getClientOriginalName()}}</p>
                     @endif
                     </div>
                     {{-- <input wire:model="birthCert" readonly type='file' class="hidden" /> --}}
                   </label>  
              
             </div>
             @error('birthCert')
             <p class="text-red-500 text-xs italic mt-4">
                 {{ "*required" }}
             </p>
             @enderror 
             {{-- {{$bCert}} --}}
         </div>
           <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
             <button type="button" wire:click.prevent='show()' class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Return</button>
             <p> Request has already been made for this student</p>
           </div>
         </form>
      @endif


    @if (session()->has('error'))
    <div class="bg-red-100 mt-2 rounded-md px-4 py-3">  
        <strong class="font-bold text-red-500">Whoops!</strong>
        <p class="text-red-500">{{session()->get('error')}}</p>
        <p class="text-red-500">Please check and try again.</p>
    </div>
     @endif
      </div>
  </div>
   @endif
  
   
</div>

