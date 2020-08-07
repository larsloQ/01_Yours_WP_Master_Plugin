// This is the reducer
function reducer( state = [], action ) {
  if ( action.type === 'ADD_TODO' ) {
    return state.concat( [ action.todo ] );
  }

  return state;
}

// These are some selectors
function getTodos( state ) {
  return state;
}

function countTodos( state ) {
  return state.length;
}

// These are the actions
function addTodo( text, done = false ) {
  return {
    type: 'ADD_TODO',
    todo: { text: text, done: done }
  };
}

// Now let's register our custom namespace
var myNamespace = 'my-todos-plugin';
wp.data.registerStore( myNamespace, { 
  reducer: reducer,
  selectors: { getTodos: getTodos, countTodos: countTodos },
  actions: { addTodo: addTodo }
} );