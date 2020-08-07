<!-- readme.md -->

# based on Atomic Blocks Accordion (1.4.23)

this setup allows to switch the sidebar inside for accordion title and content
and follows to rules below

# How to handle Blocks (LFK 2019-02-01_14.36.10)
- Compose blocks with Innerblocks. This is because we want distinct "Sidebar Inspectors" for each Block,
the outer Block and the inner
- Have not found a way to add a Sidebar-Inspector with a more general React-Component (only from Main/Parent Block)

#! Comnunicate between parent and child
with the procedure from above we need a way to let the parent know the childs settings, and the other way around.

In Main Component / Block do this (passing down props)
``` <Inspector
      { ...this.props }
    />,
```
In edit function of the main component it renders itself 
  // Render the block components
  edit: ABAccordionBlock, (see index.js in atomic-blocks/blocks/accordion/src)

  component class (edit) is above the block definition
  component class (edit) passed props down to inspector and accordion

  accordion component uses 
    { this.props.children }
  in render and takes a 