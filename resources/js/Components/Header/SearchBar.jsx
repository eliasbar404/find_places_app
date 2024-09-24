import React from 'react'
import { useState } from "react";
import { Modal ,Button} from "flowbite-react";
import {Store,CircleChevronRight,MapPinned,Search} from "lucide-react"

const SearchBar = () => {
    
    return (
    <div className='flex justify-center gap-4 mt-40 shadow-xl w-[70%] mx-auto p-10'>
        <CategoryBar/>
        <LocationBar/>

        <button className='flex items-center gap-3 font-mono font-black bg-blue-500 text-slate-50 px-10 rounded-sm'>
        <Search />
        <span>Search</span>
        </button>


    </div>
    )
}

export default SearchBar






const CategoryBar = ()=>{

    const [openModal, setOpenModal] = useState(false);


    return(
        <div className=''>
            {/* Button */}
            <button onClick={() => setOpenModal(true)} className='flex gap-2 border-2 px-5 py-2 bg-white rounded-sm'>
                <Store color='red'/>
                <span className='font-mono font-black'>Categories</span>
                <CircleChevronRight />
            </button>


      <Modal show={openModal} onClose={() => setOpenModal(false)}>
        <Modal.Header>Terms of Service</Modal.Header>
        <Modal.Body>
          <div className="space-y-6">
            <p className="text-base leading-relaxed text-gray-500 dark:text-gray-400">
              With less than a month to go before the European Union enacts new consumer privacy laws for its citizens,
              companies around the world are updating their terms of service agreements to comply.
            </p>
            <p className="text-base leading-relaxed text-gray-500 dark:text-gray-400">
              The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant
              to ensure a common set of data rights in the European Union. It requires organizations to notify users as
              soon as possible of high-risk data breaches that could personally affect them.
            </p>
          </div>
        </Modal.Body>
        <Modal.Footer>
          <Button onClick={() => setOpenModal(false)}>I accept</Button>
          <Button color="gray" onClick={() => setOpenModal(false)}>
            Decline
          </Button>
        </Modal.Footer>
      </Modal>
        




    </div>
    )
}



const LocationBar = ()=>{
    const [openModal, setOpenModal] = useState(false);
    return (

        <div className=''>
        {/* Button */}
        <button onClick={() => setOpenModal(true)} className='flex gap-2 border-2 px-5 py-2 bg-white rounded-sm'>
        <MapPinned color="orange"/>
            <span className='font-mono font-black'>Location</span>
            <CircleChevronRight />
        </button>


  <Modal show={openModal} onClose={() => setOpenModal(false)}>
    <Modal.Header>Terms of Service</Modal.Header>
    <Modal.Body>
      <div className="space-y-6">
        <p className="text-base leading-relaxed text-gray-500 dark:text-gray-400">
          With less than a month to go before the European Union enacts new consumer privacy laws for its citizens,
          companies around the world are updating their terms of service agreements to comply.
        </p>
        <p className="text-base leading-relaxed text-gray-500 dark:text-gray-400">
          The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant
          to ensure a common set of data rights in the European Union. It requires organizations to notify users as
          soon as possible of high-risk data breaches that could personally affect them.
        </p>
      </div>
    </Modal.Body>
    <Modal.Footer>
      <Button onClick={() => setOpenModal(false)}>I accept</Button>
      <Button color="gray" onClick={() => setOpenModal(false)}>
        Decline
      </Button>
    </Modal.Footer>
  </Modal>
    




</div>



    )
}