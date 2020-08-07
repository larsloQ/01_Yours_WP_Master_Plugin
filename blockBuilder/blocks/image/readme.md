# How to handle Blocks (LFK 2019-02-01_14.36.10)

- Compose blocks with Innerblocks. This is because we want distinct "Sidebar Inspectors" for each Block,
the outer Block and the inner
- Have not found a way to add a Sidebar-Inspector with a more general React-Component (only from Main/Parent Block)

#! Comnunicate between parent and child
with the procedure from above we need a way to let the parent know the childs settings, and the other way around.


##Older
Should produce hero sections like the ones in demo folder (demo-half, demo)

some specs:
- only 1 image for landscape and portrait, image need to be tested (imagetest.js)
- a free text area (where certain blocks can be added)
- a scroll down arrow (with color)

workflow:
- set image
-- test for restrictions (ratio, mind-width, min-height)
-- choose focus

props for image:
- aling full width
- align half (left side)

props for TEXTAREA:
- Headline
- FreeText
- Background-Color