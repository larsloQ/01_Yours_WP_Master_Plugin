var myNamespace = 'store-master-toggle';

// This is the reducer
function reducer( blockId = "", action ) {
  if ( action.type === 'REMEMBER_ACTIVE_BLOCK' ) {
    blockId = action.blockId;
  }
  return blockId ;
}

// These are some selectors
function getCurrentBlockId(blockId) {
  console.log("getCurrentBlockId",blockId)
  return blockId;
}

function countTodos( state ) {
  return state.length;
}

// These are the actions
function addActiveBlock( blockId ) {
  return {
    type: 'REMEMBER_ACTIVE_BLOCK',
    blockId: blockId
  };
}

// Now let's register our custom namespace
wp.data.registerStore( myNamespace, { 
  reducer: reducer,
  selectors: { getCurrentBlockId:getCurrentBlockId},
  actions: { addActiveBlock: addActiveBlock }
} );